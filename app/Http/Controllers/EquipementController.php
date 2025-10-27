<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\{Article, Categorie};
use App\Traits\FileManagementTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Http\Resources\ArticleResource;

class EquipementController extends Controller
{
   use FileManagementTrait;

	private const FOLDER = 'article_images';

    public function index(){

        $articles=Article::with(['category'])->where('published',true)->get();
        return ArticleResource::collection($articles);
    }
}
