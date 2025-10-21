@php use Illuminate\Support\Str; @endphp

@extends( Str::contains(request()->url(), 'administration') ? 'errors.admin.base' : 'errors.client.base', [
	'error' => 404,
	'message' => "Désolé, cette page semble avoir pris des vacances imprévues ! Revenez bientôt pour explorer d'autres coins de notre site.",
	'image' => asset(config('assets.404'))
])
