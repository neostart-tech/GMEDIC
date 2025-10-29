<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\MoyenPayement;
use App\Models\Article;
use App\Models\InfoBancaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Cart;

class CommandeController extends Controller
{
    /**
     * Afficher le formulaire de commande
     */
    public function create()
    {
        $cartItems = Cart::content();
        $adresses = Adresse::where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('panier')->with('error', 'Votre panier est vide.');
        }

        // Récupérer les informations bancaires depuis la base
        $infosBancaires = InfoBancaire::actif()->get();
                $adresses = Adresse::where('user_id', Auth::id())->get();


        return view('commandes.create', compact('cartItems', 'adresses', 'infosBancaires'));
    }

    /**
     * Traiter la commande
     */
    public function store(Request $request)
    {
        $request->validate([
            'adresse_id' => 'required|exists:adresses,id',
            'commentaires' => 'nullable|string|max:500',
            'methode_paiement' => 'required|in:carte,virement,cheque',
            'numero_carte' => 'required_if:methode_paiement,carte|string|max:20',
            'titulaire_carte' => 'required_if:methode_paiement,carte|string|max:255',
            'date_expiration' => 'required_if:methode_paiement,carte|date|after:today',
            'cvv' => 'required_if:methode_paiement,carte|string|max:4',
            'banque' => 'required_if:methode_paiement,cheque|string|max:255',
            'numero_cheque' => 'required_if:methode_paiement,cheque|string|max:255',
            'info_bancaire_id' => 'required_if:methode_paiement,virement|exists:infos_bancaires,id',
            'reference_virement' => 'required_if:methode_paiement,virement|string|max:255',
            'preuve_paiement' => 'required_if:methode_paiement,virement,cheque|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Vérifier que le panier n'est pas vide
            if (Cart::count() == 0) {
                return redirect()->back()->with('error', 'Votre panier est vide.');
            }

            // Générer un numéro de commande unique
            $numeroCommande = 'CMD-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            // Calculer les totaux
            $sousTotal = (float) str_replace(',', '', Cart::total());
            $fraisLivraison = $sousTotal > 10000 ? 0 : 500;
            $total = $sousTotal + $fraisLivraison;

            // Vérifier le montant minimum pour virement
            if ($request->methode_paiement === 'virement') {
                $infoBancaire = InfoBancaire::find($request->info_bancaire_id);
                if ($infoBancaire && $total < $infoBancaire->montant_minimum) {
                    return redirect()->back()->with('error', 
                        "Le montant minimum pour un virement est de " . 
                        number_format($infoBancaire->montant_minimum, 0, ',', ' ') . 
                        " FCFA.");
                }
            }

            // Créer la commande
            $commande = Commande::create([
                'user_id' => Auth::id(),
                'adresse_id' => $request->adresse_id,
                'numero_commande' => $numeroCommande,
                'date_commande' => now(),
                'date_livraison_estimee' => now()->addDays(15),
                'statut' => 'en_attente_paiement', // Nouveau statut
                'total' => $total,
                'frais_livraison' => $fraisLivraison,
                'remise' => 0,
                'commentaires' => $request->commentaires,
                'tracking_number' => 'TRK-' . strtoupper(Str::random(10)),
            ]);

            // Créer les détails de commande
            foreach (Cart::content() as $item) {
                DetailCommande::create([
                    'commande_id' => $commande->id,
                    'article_id' => $item->id,
                    'quantite' => $item->qty,
                    'prix_unitaire' => $item->price,
                    'sous_total' => $item->qty * $item->price,
                ]);

                // Mettre à jour le stock
                $article = Article::find($item->id);
                if ($article) {
                    $article->decrement('quantite', $item->qty);
                }
            }

            // Gérer le fichier de preuve de paiement
            $preuvePath = null;
            if ($request->hasFile('preuve_paiement')) {
                $preuvePath = $request->file('preuve_paiement')->store('preuves_paiement', 'public');
            }

            // Déterminer le statut du paiement selon la méthode
            $statutPaiement = 'en_attente';
            if ($request->methode_paiement === 'carte') {
                $statutPaiement = 'paye';
                // Mettre à jour le statut de la commande
                $commande->update(['statut' => 'confirmee']);
            } elseif ($request->methode_paiement === 'virement') {
                $statutPaiement = 'en_attente_validation';
            } elseif ($request->methode_paiement === 'cheque') {
                $statutPaiement = 'en_attente_encaissement';
            }

            // Enregistrer le moyen de paiement
            $paiementData = [
                'commande_id' => $commande->id,
                'methode' => $request->methode_paiement,
                'montant' => $total,
                'statut' => $statutPaiement,
                'date_paiement' => now(),
                'preuve_paiement' => $preuvePath,
            ];

            // Données spécifiques selon la méthode
            if ($request->methode_paiement === 'carte') {
                $paiementData['numero_carte'] = $request->numero_carte;
                $paiementData['titulaire_carte'] = $request->titulaire_carte;
                $paiementData['date_expiration'] = $request->date_expiration;
                $paiementData['cvv'] = $request->cvv;
            } elseif ($request->methode_paiement === 'virement') {
                $paiementData['info_bancaire_id'] = $request->info_bancaire_id;
                $paiementData['reference_paiement'] = $request->reference_virement;
                $paiementData['banque'] = InfoBancaire::find($request->info_bancaire_id)->nom_banque;
            } elseif ($request->methode_paiement === 'cheque') {
                $paiementData['banque'] = $request->banque;
                $paiementData['numero_cheque'] = $request->numero_cheque;
                $paiementData['date_encaissement'] = null; // À définir après encaissement
            }

            MoyenPayement::create($paiementData);

            // Vider le panier
            Cart::destroy();

            DB::commit();

            // Rediriger vers la page de confirmation
            return redirect()->route('commandes.confirmation', $commande->id)
                ->with('success', 'Commande créée avec succès!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors du traitement de votre commande: ' . $e->getMessage());
        }
    }

    /**
     * Afficher la confirmation de commande
     */
    public function confirmation($id)
    {
        $commande = Commande::with(['adresse', 'details.article', 'paiement.infoBancaire'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('commandes.confirmation', compact('commande'));
    }

    /**
     * API pour récupérer les infos bancaires (pour AJAX)
     */
    public function getInfosBancaires()
    {
        $infosBancaires = InfoBancaire::actif()->get();
        return response()->json($infosBancaires);
    }

    /**
     * Afficher l'historique des commandes
     */
    public function index()
    {
        $commandes = Commande::with(['adresse', 'paiement'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('commandes.index', compact('commandes'));
    }

    /**
     * Afficher les détails d'une commande
     */
    public function show($id)
    {
        $commande = Commande::with(['adresse', 'details.article', 'paiement.infoBancaire'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('commandes.show', compact('commande'));
    }

    /**
     * Annuler une commande
     */
    public function annuler($id)
    {
        $commande = Commande::where('user_id', Auth::id())->findOrFail($id);

        // On ne peut annuler que les commandes en attente de paiement
        if ($commande->statut === 'en_attente_paiement') {
            $commande->update(['statut' => 'annulee']);
            
            // Remettre les articles en stock
            foreach ($commande->details as $detail) {
                $article = Article::find($detail->article_id);
                if ($article) {
                    $article->increment('quantite', $detail->quantite);
                }
            }
            
            return redirect()->back()->with('success', 'Commande annulée avec succès.');
        }

        return redirect()->back()->with('error', 'Impossible d\'annuler cette commande.');
    }

    /**
     * Télécharger la preuve de paiement
     */
    public function downloadPreuve($id)
    {
        $paiement = MoyenPayement::whereHas('commande', function($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        if (!$paiement->preuve_paiement) {
            abort(404);
        }

        return response()->download(storage_path('app/public/' . $paiement->preuve_paiement));
    }
}