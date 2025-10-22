<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class CategoryController extends Controller
{
	public function index(): View
	{

		return view('client.categories.index')->with([
			'categories' => Categorie::query()->withCount("articles")
				->whereHas(
					'articles',
					 callback: fn(Builder $builder) => $builder->where('published', true))
				->where('published', true)->paginate(5)
		]);
	}

	// public function articlesByCategory(Categorie $categorie): View
	// {
	// 	return view('client.articles.index')->with([
	// 		'articles' => $categorie->articles()->where('published', true)->paginate(5),
	// 		'category_name' => $categorie->getAttribute('category_name')
	// 	]);
	// }
	public function articlesByCategory(Categorie $categorie): View
{
    $search = request('search');
    
    $query = $categorie->articles()->where('published', true);
    
    // Ajouter la recherche si un terme est fourni
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('article_name', 'LIKE', "%{$search}%")
              ->orWhere('article_desc', 'LIKE', "%{$search}%");
        });
    }
    
    return view('client.articles.index')->with([
        'articles' => $query->paginate(5),
        'category_name' => $categorie->getAttribute('category_name'),
        'search_term' => $search // Pour pré-remplir le champ de recherche
    ]);
}
}
