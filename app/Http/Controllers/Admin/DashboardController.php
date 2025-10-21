<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Blog, Categorie, Message, Slider};
use Illuminate\Http\Request;
use Illuminate\View\View;
use stdClass;

class DashboardController extends Controller
{
	public function __invoke(Request $request): View
	{
		$categoryData = new stdClass();
		$data = Categorie::all();
		$categoryData->published = $data->where('published', true)->count();
		$categoryData->notPublished = $data->where('published', false)->count();
		$categoryData->total = $data->count();

		$articleData = new stdClass();
		$data = Article::all();
		$articleData->published = $data->where('published', true)->count();
		$articleData->notPublished = $data->where('published', false)->count();
		$articleData->total = $data->count();


		$blogData = new stdClass();
		$data = Blog::all();
		$blogData->published = $data->where('published', true)->count();
		$blogData->notPublished = $data->where('published', false)->count();
		$blogData->total = $data->count();


		$sliderData = new stdClass();
		$data = Slider::all();
		$sliderData->published = $data->where('published', true)->count();
		$sliderData->notPublished = $data->where('published', false)->count();
		$sliderData->total = $data->count();

		$messageData = new stdClass();
		$data = Message::all();
		$messageData->published = $data->where('published', true)->count();
		$messageData->notPublished = $data->where('published', false)->count();
		$messageData->total = $data->count();


		return view('admin.dashboard', compact(
			'categoryData',
			'articleData',
			'blogData',
			'sliderData',
			'messageData'
		));
	}
}
