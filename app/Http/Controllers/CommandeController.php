<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\MoyenPayement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        return view('commandes.create', compact('cartItems', 'adresses'));
    }

    /**
     * Traiter la commande
     */
    public function store(Request $request)
    {
        $request->validate([
            'adresse_id' => 'required|exists:adresses,id',
            'commentaires' => 'nullable|string|max:500',
            'methode_paiement' => 'required|in:carte,especes,virement',
            'numero_carte' => 'required_if:methode_paiement,carte|string|max:20',
            'titulaire_carte' => 'required_if:methode_paiement,carte|string|max:255',
            'date_expiration' => 'required_if:methode_paiement,carte|date|after:today',
            'cvv' => 'required_if:methode_paiement,carte|string|max:4',
        ]);

        try {
            DB::beginTransaction();

            // Vérifier que le panier n'est pas vide
            if (Cart::count() == 0) {
                return redirect()->back()->with('error', 'Votre panier est vide.');
            }

            // Créer la commande
            $commande = Commande::create([
                'user_id' => Auth::id(),
                'adresse_id' => $request->adresse_id,
                'date_commande' => now(),
                'statut' => 'en_attente',
                'total' => Cart::total(),
                'commentaires' => $request->commentaires,
            ]);

            // Créer les détails de commande
            foreach (Cart::content() as $item) {
                DetailCommande::create([
                    'commande_id' => $commande->id,
                    'article_id' => $item->id,
                    'quantite' => $item->qty,
                    'prix_unitaire' => $item->price,
                ]);
            }

            // Enregistrer le moyen de paiement
            $paiementData = [
                'commande_id' => $commande->id,
                'methode' => $request->methode_paiement,
                'statut' => 'en_attente',
                'date_paiement' => now(),
            ];

            if ($request->methode_paiement === 'carte') {
                $paiementData['numero_carte'] = $request->numero_carte;
                $paiementData['titulaire_carte'] = $request->titulaire_carte;
                $paiementData['date_expiration'] = $request->date_expiration;
                $paiementData['cvv'] = $request->cvv;
            }

            MoyenPayement::create($paiementData);

            // Vider le panier
            Cart::destroy();

            DB::commit();

            return response()->json(['message'=>"Commande passée avec succes"]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur est survenue lors du traitement de votre commande.');
        }
    }

    /**
     * Afficher la confirmation de commande
     */
    public function confirmation($id)
    {
        $commande = Commande::with(['adresse', 'details', 'paiement'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // return view('commandes.confirmation', compact('commande'));
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

        // return view('commandes.index', compact('commandes'));
    }

    /**
     * Afficher les détails d'une commande
     */
    public function show($id)
    {
        $commande = Commande::with(['adresse', 'details.article', 'paiement'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // return view('commandes.show', compact('commande'));
    }

    /**
     * Annuler une commande
     */
    public function annuler($id)
    {
        $commande = Commande::where('user_id', Auth::id())->findOrFail($id);

        if ($commande->statut === 'en_attente') {
            $commande->update(['statut' => 'annulee']);
            
            return redirect()->back()->with('success', 'Commande annulée avec succès.');
        }

        return redirect()->back()->with('error', 'Impossible d\'annuler cette commande.');
    }
}