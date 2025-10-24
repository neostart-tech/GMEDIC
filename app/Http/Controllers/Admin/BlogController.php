<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Traits\FileManagementTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Stichoza\GoogleTranslate\GoogleTranslate;

class BlogController extends Controller
{
	use FileManagementTrait;

	private const FOLDER = "blog_images";

	public function index(): View
	{
		return view("admin.blogs.index")->with([
			'blogs' => Blog::all()
		]);
	}

	public function create(): View
	{
		return view("admin.blogs.create", [
			'blog' => new Blog(),
		]);
	}

	// public function store(BlogRequest $request): RedirectResponse
	// {
	// 	$request->merge([
	// 		'blog_image' => $this->storeFile($request, 'blog_image', static::FOLDER)
	// 	]);

	// 	Blog::query()->create($request->only(['blog_image', 'blog_description', 'blog_title']));

	// 	// dd($request->all());

	// 	return redirect()->route("admin.articles.index")->with('success', 'Blog créé avec succès');
	// }

	public function store(BlogRequest $request): RedirectResponse
{
    // Sauvegarde de l'image du blog
    $filePath = $this->storeFile($request, 'blog_image', static::FOLDER);

    // Récupération des champs
    $title = $request->get('blog_title');
    $description = $request->get('blog_description');

    // Nettoyage du HTML autorisé
    $cleanHtml = strip_tags($description, '<p><strong><em><u><br><table><tr><td><ul><li><ol><a><figure><tbody><thead><th>');

    // Langues cibles pour la traduction
    $languages = ['fr', 'en', 'zh_CN'];

    $titleTranslations = [];
    $descTranslations = [];

    // Traduction automatique
    foreach ($languages as $lang) {
        try {
            $tr = new GoogleTranslate($lang);

            $titleTranslations[$lang] = $tr->translate($title);
            $descTranslations[$lang] = $tr->translate($cleanHtml);
        } catch (\Exception $e) {
            $titleTranslations[$lang] = null;
            $descTranslations[$lang] = null;
        }
    }

    // Création du blog avec les traductions
    Blog::query()->create([
        'blog_title'       => $titleTranslations,
        'blog_description' => $descTranslations,
        'blog_image'       => $filePath,
    ]);

    return redirect()
        ->route('admin.articles.index')
        ->with('success', 'Blog créé et traduit avec succès !');
}

	public function show(Blog $blog): View
	{
		return view('admin.blogs.show', compact('blog'));
	}

	public function edit(Blog $blog): View
	{
		return view("admin.blogs.edit", compact('blog'))->with([
			'description' => 'Créer un blog',
			'action' => route('admin.blogs.update', $blog),
			'edit' => true
		]);
	}

	// public function update(BlogRequest $request, Blog $blog): RedirectResponse
	// {
	// 	$fileName = $request->hasFile('blog_image') ? $this->updateFile($request, 'blog_image', static::FOLDER, $oldName = $blog->getAttribute('blog_image')) : $blog->getAttribute('blog_image');

	// 	$blog->update([
	// 		...$request->only(['blog_title', 'blog_description']),
	// 		'blog_image' => $fileName,
	// 	]);

	// 	return redirect()->route("admin.articles.index")->with('success', 'Blog modifié avec succès');
	// }

	public function update(BlogRequest $request, Blog $blog): RedirectResponse
{
    $fileName = $request->hasFile('blog_image')
        ? $this->updateFile($request, 'blog_image', static::FOLDER, $blog->getAttribute('blog_image'))
        : $blog->getAttribute('blog_image');

    $title = $request->get('blog_title');
    $description = $request->get('blog_description');

    $cleanHtml = strip_tags($description, '<p><strong><em><u><br><table><tr><td><ul><li><ol><a><figure><tbody><thead><th>');

    $languages = ['fr', 'en', 'zh_CN'];

    $titleTranslations = [];
    $descTranslations = [];

    foreach ($languages as $lang) {
        try {
            $tr = new GoogleTranslate($lang);
            $titleTranslations[$lang] = $tr->translate($title);
            $descTranslations[$lang] = $tr->translate($cleanHtml);
        } catch (\Exception $e) {
            $titleTranslations[$lang] = $blog->blog_title[$lang] ?? $title;
            $descTranslations[$lang] = $blog->blog_description[$lang] ?? $cleanHtml;
        }
    }

    // Mise à jour du blog
    $blog->update([
        'blog_title'       => $titleTranslations,
        'blog_description' => $descTranslations,
        'blog_image'       => $fileName,
    ]);

    return redirect()
        ->route('admin.articles.index')
        ->with('success', 'Blog mis à jour et traduit avec succès !');
}

	public function destroy(Blog $blog): RedirectResponse
	{
		$this->deleteFile($blog->getAttribute('blog_image'));
		$blog->delete();
		return back()->with('success', 'Blog supprimé avec succès');
	}
}
