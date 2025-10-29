<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Slider;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function __invoke(): View
    {
        $locale = app()->getLocale();

        $articles = Article::query()
            ->where('published', true)
            ->with('category')
            ->get();

        $articles->map(function ($article) use ($locale) {
            $article->article_name = $article->article_name;
            $article->article_desc = $article->getTranslation('article_desc', $locale);
            $article->categorie_name = $article->category?->getTranslation('category_name', $locale);

            $article->article_image = $article->article_image;

            return $article;
        });

        // dd($articles);
        if ($articles->count() > 5) {
            $articles = $articles->random(5);
        }

        return view('client.welcome', [
            'sliders' => Slider::query()->where('published', true)->get(),
            'articles' => $articles, // C'est bien une Collection d'objets Article
        ]);
    }

    public function showAbout()
    {
        $articles = Categorie::query()->where('published', true)->whereHas('articles')->get();

        return view('client.apropos', compact('articles'));
    }

    public function CarteVisite1(){
        return view("client.carte-de-visite-1");
    }


    public function CarteVisite2(){
        return view("client.carte-de-visite-2");
    }

    public function showArticles()
    {
        $cartItems = CartFacade::getContent();
        $nbrArticle = CartFacade::getContent()->count();
        $totalArticle = CartFacade::getTotal();


        // dd($totalArticle);
        return view('client.index', compact('cartItems', 'nbrArticle',"totalArticle"));
    }

    public function showPanier()
    {
        $cartItems = CartFacade::getContent()->toJson();

        return view('client.Ecommerce.panier',compact("cartItems"));
    }
}
