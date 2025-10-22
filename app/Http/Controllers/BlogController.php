<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;
use Illuminate\Http\Request;


class BlogController extends Controller
{
	 public function index(Request $request): View
    {
        $search = $request->input('search');
        
        $query = Blog::query()->where('published', true);
        
        // Recherche si un terme est fourni
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('blog_title', 'LIKE', "%{$search}%");
            });
        }
        
        // Trier par date de création décroissante
        $query->orderBy('created_at', 'desc');
        
        $blogs = $query->paginate(9);
        
        return view('client.blogs.index')->with([
            'blogs' => $blogs,
            'search_term' => $search
        ]);
    }
    
    public function show(Blog $blog): View
    {
       if (!$blog->published) {
            abort(404);
        }
        
        return view('client.blogs.show')->with([
            'blog' => $blog
        ]);
    }
}
