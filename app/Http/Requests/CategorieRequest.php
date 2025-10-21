<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			"category_name" => ["required", "string"],
			'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg']
		];
	}

	public function attributes(): array
	{
		return [
			'category_name' => 'Le nom de la catégorie',
			'image' => 'L\'image d\'illustration'
		];
	}
}
