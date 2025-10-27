<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\SubCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SubCategorieController extends Controller
{
    public function index()
    {
     $subCategories = SubCategorie::with('categorie')->paginate(9);
        $categories = Categorie::all();

        return view('admin.sousCategorie.index', compact('subCategories', 'categories'));
    }


 public function store(Request $request)
{
    $request->validate([
        'sub_categorie_name' => 'required|string|max:255',
        'categorie_id' => 'required|exists:categories,id',
    ]);

    $name = $request->get('sub_categorie_name');
    
    $languages = ['fr', 'en', 'zh_CN'];
    $nameTranslations = [];

    foreach ($languages as $lang) {
        try {
            $tr = new GoogleTranslate($lang);
            $nameTranslations[$lang] = $tr->translate($name);
        } catch (\Exception $e) {
            $nameTranslations[$lang] = $name;
        }
    }

   

    SubCategorie::create([
        'sub_categorie_name' => $nameTranslations,
        'categorie_id' => $request->categorie_id,
        'slug' => Str::slug($name),
    ]);

    return redirect()->route('admin.sub-categories.index')
        ->with('success', 'Sous-catégorie créée et traduite avec succès.');
}
   

   public function update(Request $request, SubCategorie $subCategorie)
{
    $request->validate([
        'sub_categorie_name' => 'required|string|max:255',
        'categorie_id' => 'required|exists:categories,id',
    ]);

    $name = $request->get('sub_categorie_name');
    
    $languages = ['fr', 'en', 'zh_CN'];
    $nameTranslations = [];

    // Traduction automatique
    foreach ($languages as $lang) {
        try {
            $tr = new GoogleTranslate($lang);
            $nameTranslations[$lang] = $tr->translate($name);
        } catch (\Exception $e) {
            $nameTranslations[$lang] = $name;
        }
    }

    

    // Mise à jour de la sous-catégorie
    $subCategorie->update([
        'sub_categorie_name' => $nameTranslations,
        'categorie_id' => $request->categorie_id,
        'slug' => Str::slug($name),
    ]);

    return redirect()->route('admin.sub-categories.index')
        ->with('success', 'Sous-catégorie mise à jour et traduite avec succès.');
}
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(SubCategorie $subCategorie)
    // {
    //     $subCategorie->delete();

    //     // return redirect()->route('admin.sub-categories.index')
    //     //     ->with('success', 'Sous-catégorie supprimée avec succès.');
    // }

    /**
     * Get subcategories by category ID (for AJAX requests)
     */
    // public function getByCategory($categoryId)
    // {
    //     $subCategories = SubCategorie::where('categorie_id', $categoryId)->get();

    //     return response()->json($subCategories);
    // }
}
