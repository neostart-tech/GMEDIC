<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthClientController extends Controller
{

  public function doLogin(){
    return view('client.auth.authentification');
  }

  public function doRegister(){
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

        $user = User::where('email', $validate['email'])->exists();

        if (! $user) {
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
            'email' => 'required|exists:users,email',
            'password' => 'required',
            'name' => 'required',
        ], [
            'email.required' => 'Email est requis',
            'email.exists' => 'Désolé le Email que vous avez saisie existe déja',
            'password.required' => 'Le mot de passe est requis',
            'name.required' => 'Le nom et le prénom sont requis',
        ]);

        User::create([
            ...$validate,
            'role_id' => 3,
        ]);

        return redirect()->route('client.dologin')->with('success', 'Création de compte effectué avec succes');

    }
}
