<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
    public function doLogin()
    {
        return view('client.auth.authentification');
    }

    public function doRegister()
    {
        return view('client.auth.register');
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email est requis',
            'password.required' => 'Le mot de passe est requis',

        ]);

        $exist = User::where('email', $validate['email'])->exists();
        $user = User::where('email', $validate['email'])->first();

        if (! $exist) {
            return redirect()->back()->with('error', 'Email incorrect');
        }

        if (! Hash::check($validate['password'], $user->password)) {
            return redirect()->back()->with('error', 'Mot de passe incorrect');
        }

        Auth::attempt($validate);

        return redirect()->route('client.show-panier')->with('success', 'Authentification effectué avec succes');

    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'name' => 'required|string|max:255',
        ], [
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'Désolé, cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            'name.required' => 'Le nom et le prénom sont requis.',
        ]);

        try {
            User::create([
                'name' => $validate['name'],
                'email' => $validate['email'],
                'password' => Hash::make($validate['password']),
                'role_id' => 3,
            ]);
        } catch (Exception $e) {
            throw new Error($e->getMessage());
        }

        return redirect()->route('client.dologin')
            ->with('success', 'Création de compte effectuée avec succès.');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion effectuée avec succès.',
        ]);
    }

   public function update(Request $request, User $user)
{
    if (auth()->id() !== $user->id) {
        return response()->json([
            'success' => false,
            'message' => 'Non autorisé à modifier ce profil.',
        ], 403);
    }

    $validate = $request->validate([
        "name" => "required|string|max:255",
        "email" => "required|email|unique:users,email," . $user->id,
        "password" => "nullable|confirmed",
        "current_password" => "required_with:password",
    ]);

    if ($request->filled('password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'L\'ancien mot de passe est incorrect.',
            ], 422);
        }
        
        $validate['password'] = Hash::make($request->password);
    } else {
        unset($validate['password']);
    }

    unset($validate['current_password']);

    $user->update($validate);

    return response()->json([
        'success' => true,
        'message' => 'Profil modifié avec succès.',
    ]);
}
}
