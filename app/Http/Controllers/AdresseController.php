<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdresseController extends Controller
{
    /**
     * Liste des adresses de l’utilisateur connecté.
     */
    public function index()
    {
        $adresses = Adresse::where('user_id', Auth::id())->get();

        return response()->json($adresses);
    }

    /**
     * Enregistre une nouvelle adresse.
     */
 public function store(Request $request)
{
    $validated = $request->validate([
        'etablissement' => 'nullable|string|max:255',
        'adresse' => 'required|string|max:255',
        'ville' => 'required|string|max:100',
        'code_postal' => 'required|string|max:20',
        'telephone' => 'nullable|string|max:20',
        'notes_livraison' => 'nullable|string|max:500',
    ]);

    // Désactiver les autres adresses si une nouvelle est active
    if ($request->is_active) {
        Adresse::where('user_id', Auth::id())->update(['is_active' => false]);
    }

    // Créer la nouvelle adresse
    $adresse = Adresse::updateOrCreate([
        'user_id' => Auth::id(),
        ...$validated,
        'is_active' => $request->is_active ? true : false,
    ]);

    return response()->json([
        'message' => 'Adresse enregistrée avec succès.',
        'adresse' => $adresse,
    ]);
}


    /**
     * Affiche une adresse spécifique.
     */
    public function show($id)
    {
        $adresse = Adresse::where('user_id', Auth::id())->findOrFail($id);

        return response()->json($adresse);
    }

    /**
     * Met à jour une adresse.
     */
    public function update(Request $request, $id)
    {
        $adresse = Adresse::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'etablissement' => 'nullable|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'code_postal' => 'required|string|max:20',
            'telephone' => 'nullable|string|max:20',
            'notes_livraison' => 'nullable|string|max:500',
        ]);

        $adresse->update($validated);

        return response()->json([
            'message' => 'Adresse mise à jour avec succès.',
            'adresse' => $adresse,
        ]);
    }

    /**
     * Supprime une adresse.
     */
    public function destroy($id)
    {
        $adresse = Adresse::where('user_id', Auth::id())->findOrFail($id);
        $adresse->delete();

        return response()->json(['message' => 'Adresse supprimée avec succès.']);
    }

    /**
     * Active une adresse comme adresse principale.
     */
    public function activer($id)
    {
        $adresse = Adresse::where('user_id', Auth::id())->findOrFail($id);

        // Désactiver les autres adresses de l’utilisateur
        Adresse::where('user_id', Auth::id())->update(['is_active' => false]);

        // Activer celle-ci
        $adresse->update(['is_active' => true]);

        return response()->json([
            'message' => 'Adresse activée comme principale.',
            'adresse' => $adresse,
        ]);
    }
}
