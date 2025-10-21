<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\View\View;

class ContacterController extends Controller
{
	public function index(): View
	{
		return view('client.contact');
	}

	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'nom' => ['required'],
			'email' => ['required', 'email'],
			'message' => ['required', 'min:16', 'max:1024'],
			'telephone' => ['required']
		], [
			'nom.required' => 'Votre nom et vos prénoms sont obligatoires',
			'email.required' => 'Votre adresse mail est obligatoire',
			'email.email' => 'Votre adresse mail doit être une adresse mail valide',
			'message.required' => 'Le contenu de votre message est obligatoire',
			'message.min' => 'Le contenu de votre message doit contenir au moins 25 caractères',
			'telephone.required' => 'Votre numéro de téléphone est obligatoire',
		]);

		Message::query()->create([
			'message' => $request->get('message'),
			'email' => $request->get('email'),
			'telephone' => $request->get('telephone'),
			'nom' => $request->get('nom'),
		]);

		return back()->with(['success' => "Votre message nous a été envoyé avec succès. Nous essayerons de vous répondre dans les plus brefs délais."]);
	}
}
