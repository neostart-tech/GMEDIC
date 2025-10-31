<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\{Article, Categorie,SubCategorie};
use App\Traits\FileManagementTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategorieResource;
use App\Http\Resources\SousCategorieResource;


class EquipementController extends Controller
{
   use FileManagementTrait;

	private const FOLDER = 'article_images';

       public function index()
    {
        $articles = Article::with(['category', 'subCategorie'])
                          ->where('published', true)
                          ->get();
        
        $categories = Categorie::all();
        $subCategories = SubCategorie::all();
        
        return response()->json([
            'articles' => ArticleResource::collection($articles),
            'categories' =>CategorieResource::collection($categories), 
            'sub_categories' => SousCategorieResource::collection($subCategories),
        ]);
    }


     public function show(Article $article){
        $articles=Article::with(['category','subCategorie'])->where('published',true)->where("id",$article->id)->get();
        $othersArticles=Article::with(['category','subCategorie'])->where('published',true)->where("id","!=",$article->id)->get()->take(12);
        return response()->json(["articles"=>ArticleResource::collection($articles),"othersArticles"=>ArticleResource::collection($othersArticles)]);
    }


    public function showDetail(Article $article){
        
        return view('client.Ecommerce.detailArticle',compact('article'));
    }
    
}
