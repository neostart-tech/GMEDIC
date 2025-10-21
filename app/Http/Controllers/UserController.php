<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\{Role, User};
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
	public function index(): View
	{
		return view('admin.users.index')->with([
			'users' => User::query()->with('role')->get(),
			'roles' => Role::all()->reverse()
		]);
	}

	public function store(UserRequest $request): RedirectResponse
	{
		User::query()->create([
			...$request->only(['name', 'email', 'role_id']),
			'password' => Hash::make('password'),
		]);

		return back()->with(['success' => 'Utilisateur ajouté avec succès']);
	}

	public function update(UserRequest $request, User $user): RedirectResponse
	{
		$user->update([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'role_id' => $request->get('role_id') ?? $user->getAttribute('role_id')
		]);

		return back()->with(['success' => ' Informations de l\'utilisateur mises à jour avec succès']);
	}

	public function destroy(User $user): RedirectResponse
	{
		$user->delete();
		return back()->with(['success' => 'Utilisateur ajouté avec succès']);
	}
}
