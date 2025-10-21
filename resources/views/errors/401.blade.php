@php use Illuminate\Support\Str; @endphp

@extends( Str::contains(request()->url(), 'administration') ? 'errors.admin.base' : 'errors.client.base', [
	'error' => 401,
	'message' => "Désolé, vous n'êtes pas autorisé à accéder à cette page. Veuillez vous connecter ou vérifier vos informations d'identification !",
	'image' => asset(config('assets.401'))
])
