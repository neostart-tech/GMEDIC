<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'slider_desc' => ['required', 'string', 'max:565'],
			'slide_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
		];

	}

	public function attributes(): array
	{
		return [
			'slider_desc' => "La description du slider",
			'slide_image' => "L'image du slider",
		];
	}
}
