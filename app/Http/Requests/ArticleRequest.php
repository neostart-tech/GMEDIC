<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{

	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		$rules = [
			'article_name' => ['required', 'string', 'max:255'],
			'article_desc' => ['required'],
			'article_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp'],
			'published' => ['boolean'],
			'categorie_id' => ['required', 'exists:categories,id'],
		];

		if ($this->routeIs('admin.articles.store')) {
			$rules['article_image'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp'];
		}

		return $rules;
	}

	public function attributes(): array
	{
		return [
			'article_name' => "Nom de l'article",
			'article_desc' => "Description de l'article",
			'article_image' => "L'image de l'article",
			'categorie_id' => "La catégorie",
		];
	}
}
