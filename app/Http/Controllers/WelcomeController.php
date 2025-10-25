<?php

namespace App\Http\Controllers;

use App\Models\{Article, Slider,Categorie};
use Illuminate\View\View;

class WelcomeController extends Controller
{
	public function __invoke(): View
	{
		$articles = Article::query()->where('published', true)->get();
		if ($articles->count() > 5) {
			$articles = $articles->random(5);
		}
		return view('client.welcome')->with([
			'sliders' => Slider::query()->where('published', true)->get(),
			'articles' => $articles
		]);
	}


	public function showAbout(){
	    $articles = Categorie::query()->where('published', true)->whereHas('articles')->get();


		return view('client.apropos',compact('articles'));
	}
}
