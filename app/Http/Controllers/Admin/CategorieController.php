<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieRequest;
use App\Models\Categorie;
use App\Traits\FileManagementTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\{RedirectResponse, Response};
use Illuminate\View\View;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CategorieController extends Controller
{
	use FileManagementTrait;

	static string $folder = "categories";

	public function index(): View
	{
		return view('admin.categories.index', [
			'categories' => Categorie::query()
				->withCount('articles')
				->orderBy('category_name')
				->get()
		]);
	}

	// public function store(CategorieRequest $request): RedirectResponse
	// {
	// 	$filePath = $request->hasFile('image') ? $this->storeFile($request, 'image', static::$folder) : null;
	// 	Categorie::create([
	// 		'category_name' => $request->get('category_name'),
	// 		'image' => $filePath
	// 	]);
	// 	return back()->with('success', 'Categorie créée avec succès');
	// }

	public function store(CategorieRequest $request): RedirectResponse
{
    $filePath = $request->hasFile('image') 
        ? $this->storeFile($request, 'image', static::$folder) 
        : null;

    $name = $request->get('category_name');
    $languages = ['fr', 'en', 'zh_CN'];
    $nameTranslations = [];

    // Traduction automatique
    foreach ($languages as $lang) {
        try {
            $tr = new GoogleTranslate($lang);
            $nameTranslations[$lang] = $tr->translate($name);
        } catch (\Exception $e) {
            $nameTranslations[$lang] = null;
        }
    }

    Categorie::create([
        'category_name' => $nameTranslations,
        'image' => $filePath
    ]);

    return back()->with('success', 'Categorie créée avec succès');
}

	public function updatePublishedState(Categorie $categorie): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
	{
		$categorie->update([
			'published' => $status = ($categorie->getAttribute('published') === 0 ? 1 : 0)
		]);

		return response([
			'message' => "Configuration appliquée avec succès",
			'icon' => 'fas fa-lock-' . ($status ? "-open text-success" : ' text-danger')
		]);
	}

	// public function update(CategorieRequest $request, Categorie $categorie): RedirectResponse
	// {
	// 	$filePath = $categorie->getAttribute('image');

	// 	if ($request->hasFile('image')) {
	// 		$filePath = !$filePath ? $this->storeFile($request, 'image', static::$folder) : $this->updateFile($request, 'image', static::$folder, $filePath);
	// 	}

	// 	$categorie->update([
	// 		'category_name' => $request->get('category_name'),
	// 		'image' => $filePath
	// 	]);

	// 	return back()->with('success', 'Categorie mise à jour avec succès');
	// }

	public function update(CategorieRequest $request, Categorie $categorie): RedirectResponse
{
    $filePath = $categorie->getAttribute('image');

    if ($request->hasFile('image')) {
        $filePath = !$filePath
            ? $this->storeFile($request, 'image', static::$folder)
            : $this->updateFile($request, 'image', static::$folder, $filePath);
    }

    $name = $request->get('category_name');
    $languages = ['fr', 'en', 'zh_CN'];
    $nameTranslations = [];

    foreach ($languages as $lang) {
        try {
            $tr = new GoogleTranslate($lang);
            // $tr->setSource('auto');
            $nameTranslations[$lang] = $tr->translate($name);
        } catch (\Exception $e) {
            $nameTranslations[$lang] = null;
        }
    }

    $categorie->update([
        'category_name' => $nameTranslations,
        'image' => $filePath
    ]);

    return back()->with('success', 'Categorie mise à jour avec succès');
}

	public function destroy(Categorie $categorie): RedirectResponse
	{
		if ($categorie->articles->isNotEmpty()) {
			return back()->with(
				'warning',
				'Impossible de supprimer cette catégorie, car des articles dépendent de son existence'
			);
		}

		$this->deleteFile($categorie->getAttribute('image') ?? '');
		$categorie->delete();
		return back()->with('success', 'Categorie supprimée avec succès');
	}
}
