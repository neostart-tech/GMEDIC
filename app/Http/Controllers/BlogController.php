<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;

class BlogController extends Controller
{
	public function index(): View
	{
		return view('client.blogs.index')->with([
			'blogs' => Blog::query()->where('published', true)->get()
		]);
	}

	public function show(Blog $blog): View
	{
		return view('client.blogs.show', compact('blog'));
	}
}
