<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\{Article, Categorie};
use App\Traits\FileManagementTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class ArticleController extends Controller
{
	use FileManagementTrait;

	private const FOLDER = 'article_images';

	public function index(): View
	{
		// dd(Article::with('category:id,category_name,slug')->orderByDesc('created_at')->get());
		return view('admin.article.index', [
			'articles' => Article::with('category:id,category_name,slug')->orderByDesc('created_at')->get(),
			'categories' => Categorie::query()->has('articles')->orderBy('category_name')->get()
		]);
	}

	public function create(): View
	{
		return view('admin.article.create', [
			'categories' => Categorie::query()->orderBy('category_name')->get(),
			'article' => new Article(),
		]);
	}

	public function store(ArticleRequest $request): RedirectResponse
	{
		$filePath = $this->storeFile($request, 'article_image', static::FOLDER);

		Article::query()->create([
			'article_name' => $request->get('article_name'),
			'categorie_id' => $request->get('categorie_id'),
			'article_desc' => $request->get('article_desc'),
			'article_image' => $filePath,
		]);

		return to_route('admin.articles.index')->with('success', 'Article créé avec succès');
	}

	public function edit(Article $article): View
	{
		$categories = Categorie::all()->sortBy('category_name');
		return view('admin.article.edit', compact('categories', 'article'));
	}

	public function update(ArticleRequest $request, Article $article): RedirectResponse
	{
		$filePath = $article->getAttribute('article_image');
		if ($request->hasFile('article_image'))
			$filePath = $this->updateFile($request, 'article_image', static::FOLDER, $filePath);

		$article->update([
			'article_name' => $request->get('article_name'),
			'categorie_id' => $request->get('categorie_id'),
			'article_desc' => $request->get('article_desc'),
			'article_image' => $filePath,
		]);

		return to_route('admin.articles.index')->with('success', 'Article mis à jour avec succès');
	}

	public function destroy(Article $article): RedirectResponse
	{
		$this->deleteFile($article->getAttribute('article_image'));
		$article->delete();
		return to_route('admin.articles.index')->with('success', 'Article supprimé avec succès');
	}
}
