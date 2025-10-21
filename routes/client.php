<?php


use App\Http\Controllers\{BlogController, CategoryController, ContacterController, WelcomeController};
use Illuminate\Support\Facades\Route;

Route::name('client.')->group(function () {
	Route::get('', WelcomeController::class)->name('accueil');
	Route::view('a-propos', 'client.apropos')->name('a-propos');

	Route::controller(BlogController::class)->prefix('blogs')->name('blogs.')->group(function () {
		Route::get('', 'index')->name('index');
		Route::get('{blog}/lire', 'show')->name('show');
	});

	Route::controller(ContacterController::class)->prefix('nous-contacter')->name('contact.')->group(function () {
		Route::get('', 'index')->name('create');
		Route::post('', 'store')->name('store');
	});

	Route::controller(CategoryController::class)->prefix('categorie')->name('categories.')->group(function () {
		Route::get('liste', 'index')->name('index');
		Route::get('{categorie}/articles', 'articlesByCategory')->name('get-articles');
	});

});
