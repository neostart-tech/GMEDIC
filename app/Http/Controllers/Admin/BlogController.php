<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Traits\FileManagementTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

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

	public function store(BlogRequest $request): RedirectResponse
	{
		$request->merge([
			'blog_image' => $this->storeFile($request, 'blog_image', static::FOLDER)
		]);

		Blog::query()->create($request->only(['blog_image', 'blog_description', 'blog_title']));

		return redirect()->route("admin.articles.index")->with('success', 'Blog créé avec succès');
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

	public function update(BlogRequest $request, Blog $blog): RedirectResponse
	{
		$fileName = $request->hasFile('blog_image') ? $this->updateFile($request, 'blog_image', static::FOLDER, $oldName = $blog->getAttribute('blog_image')) : $blog->getAttribute('blog_image');

		$blog->update([
			...$request->only(['blog_title', 'blog_description']),
			'blog_image' => $fileName,
		]);

		return redirect()->route("admin.articles.index")->with('success', 'Blog modifié avec succès');
	}

	public function destroy(Blog $blog): RedirectResponse
	{
		$this->deleteFile($blog->getAttribute('blog_image'));
		$blog->delete();
		return back()->with('success', 'Blog supprimé avec succès');
	}
}
