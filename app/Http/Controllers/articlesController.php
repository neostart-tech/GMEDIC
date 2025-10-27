<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\{Article, Categorie};
use App\Traits\FileManagementTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Stichoza\GoogleTranslate\GoogleTranslate;

class articlesController extends Controller
{
	use FileManagementTrait;

	private const FOLDER = 'article_images';

    public function index(){

        $articles=Articles::with(['category'])->where('published',true)->get();
        return ArticleResource::collection($articles);
    }


}
