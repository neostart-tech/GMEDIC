<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		// Seuls les admins peuvent changer les rôles donc, pour eux, cette donnée sera obligatoire
		$userId = null;
		$user = $this->route()->parameter('user');
		if ($user) {
			$userId = $user->id;
		}

		return [
			'name' => ['required'],
			'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
			'role_id' => [$this->user()->id === 2 ? 'nullable' : 'required', 'exists:roles,id']
		];
	}

	public function attributes(): array
	{
		return [
			'name' => 'Le nom de l\'utilisateur',
			'email' => 'L\'adresse mail de l\'utilisateur',
			'role_id' => 'Le rôle',
		];
	}
}
