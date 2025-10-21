<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'blog_title' => ['required', 'string'],
			'blog_description' => ['required'],
			'blog_image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp,gif'],
		];
	}

	public function attributes(): array
	{
		return [
			'blog_title' => 'Le libellé du blog',
			'blog_description' => 'La description du blog',
			'blog_image' => 'L\'image du blog'
		];
	}
}
