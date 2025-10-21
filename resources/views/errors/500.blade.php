@php use Illuminate\Support\Str; @endphp

@extends( Str::contains(request()->url(), 'administration') ? 'errors.admin.base' : 'errors.client.base', [
	'error' => 500,
	'message' => "Oups, il semble y avoir eu une petite panne technique de notre côté. Nos experts travaillent dessus pour rétablir la situation au plus vite. Merci de votre patience !",
	'image' =>asset(config('assets.404'))
])
