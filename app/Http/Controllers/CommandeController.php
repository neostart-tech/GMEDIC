<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\Article;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\InfoBancaire;
use App\Models\MoyenPayement;
use App\Models\User;
use Cart;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    // public function store(Request $request)
    // {
    //     // Valider les données de base
    //     $request->validate([
    //         'adresse_id' => 'required|exists:adresses,id',
    //         'commentaires' => 'nullable|string|max:500',
    //         'methode_paiement' => 'required|in:card,transfer,check',
    //         'articles' => 'required|array',
    //         'articles.*.id' => 'required|exists:articles,id',
    //         'articles.*.quantite' => 'required|integer|min:1',
    //         'paiement_details' => 'required|array',
    //         'preuve_paiement' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // Fichier optionnel
    //     ]);

    //     // Validation conditionnelle selon la méthode de paiement
    //     if ($request->methode_paiement === 'card') {
    //         $request->validate([
    //             'paiement_details.numero_carte' => 'required|string|max:20',
    //             'paiement_details.titulaire_carte' => 'required|string|max:255',
    //             'paiement_details.date_expiration' => 'required|date|after:today',
    //             'paiement_details.cvv' => 'required|string|max:4',
    //         ]);
    //     } elseif ($request->methode_paiement === 'transfer') {
    //         $request->validate([
    //             'paiement_details.info_bancaire_id' => 'required|exists:infos_bancaires,id',
    //             'paiement_details.reference_virement' => 'required|string|max:255',
    //         ]);
    //         // Pour virement, le fichier est requis
    //         $request->validate([
    //             'preuve_paiement' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
    //         ]);
    //     } elseif ($request->methode_paiement === 'check') {
    //         $request->validate([
    //             'paiement_details.banque' => 'required|string|max:255',
    //             'paiement_details.numero_cheque' => 'required|string|max:255',
    //         ]);
    //         // Pour chèque, le fichier est requis
    //         $request->validate([
    //             'preuve_paiement' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
    //         ]);
    //     }

    //     try {
    //         DB::beginTransaction();

    //         // Vérifier que le panier n'est pas vide
    //         if (empty($request->articles)) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Votre panier est vide.'
    //             ], 400);
    //         }

    //         // Calculer les totaux à partir des articles envoyés
    //         $sousTotal = 0;
    //         foreach ($request->articles as $article) {
    //             $articleModel = Article::find($article['id']);
    //             if ($articleModel) {
    //                 $sousTotal += $article->prix * $article['quantite'];
    //             }
    //         }

    //         $fraisLivraison = 0;
    //         $total = $sousTotal + $fraisLivraison;

    //         // Générer un numéro de commande unique
    //         $numeroCommande = 'CMD-' . date('Ymd') . '-' . strtoupper(Str::random(6));

    //         // Créer la commande
    //         $commande = Commande::create([
    //             'user_id' => Auth::id(),
    //             'adresse_id' => $request->adresse_id,
    //             'numero_commande' => $numeroCommande,
    //             'date_commande' => now(),
    //             'statut' => 'en_attente',
    //             'total' => $total,
    //             // 'remise' => 0,
    //             'commentaires' => $request->commentaires,
    //             // 'tracking_number' => 'TRK-' . strtoupper(Str::random(10)),
    //         ]);

    //         // Créer les détails de commande
    //         foreach ($request->articles as $item) {
    //             $article = Article::find($item['id']);
    //             if ($article) {
    //                 DetailCommande::create([
    //                     'commande_id' => $commande->id,
    //                     'article_id' => $article->id,
    //                     'quantite' => $item['quantite'],
    //                     'prix_unitaire' => $item['prix'],
    //                     // 'sous_total' => $item['quantite'] * $item['prix'],
    //                 ]);
    //             }
    //         }

    //         // Gérer le fichier de preuve de paiement
    //         $preuvePath = null;
    //         if ($request->hasFile('preuve_paiement')) {
    //             $preuvePath = $request->file('preuve_paiement')->store('preuves_paiement', 'public');
    //         }

    //         // Déterminer le statut du paiement selon la méthode
    //         $statutPaiement = 'en_attente';
    //         $statutCommande = 'en_attente_paiement';

    //         if ($request->methode_paiement === 'card') {
    //             $statutPaiement = 'paye';
    //             $statutCommande = 'confirmee';
    //         } elseif ($request->methode_paiement === 'transfer') {
    //             $statutPaiement = 'en_attente_validation';
    //         } elseif ($request->methode_paiement === 'check') {
    //             $statutPaiement = 'en_attente_encaissement';
    //         }

    //         // Mettre à jour le statut de la commande
    //         $commande->update(['statut' => $statutCommande]);

    //         // Enregistrer le moyen de paiement
    //         $paiementData = [
    //             'commande_id' => $commande->id,
    //             'methode' => $request->methode_paiement,
    //             'montant' => $total,
    //             'statut' => $statutPaiement,
    //             'date_paiement' => now(),
    //             'preuve_paiement' => $preuvePath,
    //         ];

    //         // Données spécifiques selon la méthode
    //         if ($request->methode_paiement === 'card') {
    //             $paiementData['numero_carte'] = $request->paiement_details['numero_carte'];
    //             $paiementData['titulaire_carte'] = $request->paiement_details['titulaire_carte'];
    //             $paiementData['date_expiration'] = $request->paiement_details['date_expiration'];
    //             $paiementData['cvv'] = $request->paiement_details['cvv'];
    //         } elseif ($request->methode_paiement === 'transfer') {
    //             $paiementData['info_bancaire_id'] = $request->paiement_details['info_bancaire_id'];
    //             $paiementData['reference_paiement'] = $request->paiement_details['reference_virement'];
    //             $infoBancaire = InfoBancaire::find($request->paiement_details['info_bancaire_id']);
    //             $paiementData['banque'] = $infoBancaire ? $infoBancaire->nom_banque : 'Inconnue';
    //         } elseif ($request->methode_paiement === 'check') {
    //             $paiementData['banque'] = $request->paiement_details['banque'];
    //             $paiementData['numero_cheque'] = $request->paiement_details['numero_cheque'];
    //             $paiementData['date_encaissement'] = null;
    //         }

    //         MoyenPayement::create($paiementData);

    //         DB::commit();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Commande créée avec succès!',
    //             'numero_commande' => $numeroCommande,
    //             'commande_id' => $commande->id
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Une erreur est survenue lors du traitement de votre commande: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function store(Request $request)
    {

        // Valider les données de base
        $request->validate([
            'adresse_id' => 'required|exists:adresses,id',
            'commentaires' => 'nullable|string|max:500',
            'methode_paiement' => 'required|in:card,transfer,check',
            'articles' => 'required|string', // Maintenant c'est une string JSON
            'paiement_details' => 'required|array',
            'preuve_paiement' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Décoder les articles
        $articles = json_decode($request->articles, true);
        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($articles)) {
            return response()->json([
                'success' => false,
                'message' => 'Format des articles invalide.',
            ], 400);
        }

        if ($request->methode_paiement === 'card') {
            \Log::info($request->all());

            $request->validate([
                'paiement_details.numero_carte' => 'required|string|max:20',
                'paiement_details.titulaire_carte' => 'required|string|max:255',
                'paiement_details.date_expiration' => 'required',
                'paiement_details.cvv' => 'required|string|max:4',
            ]);

        } elseif ($request->methode_paiement === 'transfer') {
            $request->validate([
                'paiement_details.info_bancaire_id' => 'required|exists:info_bancaires,id',
                'paiement_details.reference_virement' => 'required|string|max:255',
            ]);
            $request->validate([
                'preuve_paiement' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            ]);
        } elseif ($request->methode_paiement === 'check') {
            $request->validate([
                'paiement_details.banque' => 'required|string|max:255',
                'paiement_details.numero_cheque' => 'required|string|max:255',
            ]);
            $request->validate([
                'preuve_paiement' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            ]);
        }

        try {
            DB::beginTransaction();

            if (empty($articles)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Votre panier est vide.',
                ], 400);
            }

            $sousTotal = 0;
            foreach ($articles as $article) {
                $articleModel = Article::find($article['id']);
                if ($articleModel) {
                    $sousTotal += $article['prix'] * $article['quantite'];
                }
            }

            $fraisLivraison = 0;
            $total = $sousTotal + $fraisLivraison;

            $numeroCommande = 'CMD-'.date('Ymd').'-'.strtoupper(Str::random(6));

            $commande = Commande::create([
                'user_id' => Auth::id(),
                'adresse_id' => $request->adresse_id,
                'numero_commande' => $numeroCommande,
                'date_commande' => now(),
                'statut' => 'en_attente',
                'total' => $total,
                'commentaires' => $request->commentaires,
            ]);

            foreach ($articles as $item) {
                $article = Article::find($item['id']);
                if ($article) {
                    DetailCommande::create([
                        'commande_id' => $commande->id,
                        'article_id' => $article->id,
                        'quantite' => $item['quantite'],
                        'prix_unitaire' => $item['prix'],
                    ]);
                }
            }

            $preuvePath = null;
            if ($request->hasFile('preuve_paiement')) {
                $preuvePath = $request->file('preuve_paiement')->store('preuves_paiement', 'public');
            }

            $statutPaiement = 'en_attente';
            $statutCommande = 'en_attente_paiement';

            if ($request->methode_paiement === 'card') {
                $statutPaiement = 'paye';
                $statutCommande = 'confirmee';
            } elseif ($request->methode_paiement === 'transfer') {
                $statutPaiement = 'en_attente_validation';
            } elseif ($request->methode_paiement === 'check') {
                $statutPaiement = 'en_attente_encaissement';
            }

            $commande->update(['statut' => $statutCommande]);

            $paiementData = [
                'commande_id' => $commande->id,
                'methode' => $request->methode_paiement,
                'montant' => $total,
                'statut' => $statutPaiement,
                'date_paiement' => now(),
                'preuve_paiement' => $preuvePath,
            ];

            if ($request->methode_paiement === 'card') {
                $paiementData['numero_carte'] = $request->paiement_details['numero_carte'];
                $paiementData['titulaire_carte'] = $request->paiement_details['titulaire_carte'];
                $paiementData['date_expiration'] = $request->paiement_details['date_expiration'];
                $paiementData['cvv'] = $request->paiement_details['cvv'];
            } elseif ($request->methode_paiement === 'transfer') {
                $paiementData['info_bancaire_id'] = $request->paiement_details['info_bancaire_id'];
                $paiementData['reference_paiement'] = $request->paiement_details['reference_virement'];
                $infoBancaire = InfoBancaire::find($request->paiement_details['info_bancaire_id']);
                $paiementData['banque'] = $infoBancaire ? $infoBancaire->nom_banque : 'Inconnue';
            } elseif ($request->methode_paiement === 'check') {
                $paiementData['banque'] = $request->paiement_details['banque'];
                $paiementData['numero_cheque'] = $request->paiement_details['numero_cheque'];
                $paiementData['date_encaissement'] = null;
            }

            MoyenPayement::create($paiementData);

            $admins = User::whereIn('role_id', [1, 2])->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NewOrderMail($commande));
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Commande créée avec succès!',
                'numero_commande' => $numeroCommande,
                'commande_id' => $commande->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur création commande: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du traitement de votre commande: '.$e->getMessage(),
            ], 500);
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
        $paiement = MoyenPayement::whereHas('commande', function ($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        if (! $paiement->preuve_paiement) {
            abort(404);
        }

        return response()->download(storage_path('app/public/'.$paiement->preuve_paiement));
    }
}
