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

	public function articlesByCategory(Categorie $categorie): View
	{
		return view('client.articles.index')->with([
			'articles' => $categorie->articles()->where('published', true)->get(),
			'category_name' => $categorie->getAttribute('category_name')
		]);
	}
}
