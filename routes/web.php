<?php

use App\Http\Controllers\Admin\{ArticleController,
	BlogController,
	CategorieController,
	DashboardController,
	MessageController,
	SliderController,
	VisibilityToggleController
};
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('administration')->name('admin.')->group(function () {
	Route::get('', fn() => to_route('admin.dashboard'));
	Route::patch('toggle-visibility', VisibilityToggleController::class)->name('toggle-visibility');
	Route::get('dashboard', DashboardController::class)->name('dashboard');

	Route::controller(ArticleController::class)->name('articles.')->prefix('articles')->group(function () {
		Route::get('liste', 'index')->name('index');
		Route::get('ajouter-un-article', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('{article}/modifier', 'edit')->name('edit');
		Route::put('{article}/modifier', 'update')->name('update');
		Route::delete('delete/{article}', 'destroy')->name('delete');
	});

	Route::controller(BlogController::class)->name('blogs.')->prefix('blogs')->group(function () {
		Route::get('liste', 'index')->name('index');
		Route::get('ajouter-un-blog', 'create')->name('create');
		Route::post('store', 'store')->name('store');
		Route::get('{blog}/details', 'show')->name('show');
		Route::get('{blog}/modifier', 'edit')->name('edit');
		Route::put('{blog}/modifier', 'update')->name('update');
		Route::delete('{blog}/supprimer', 'destroy')->name('delete');
	});

	Route::controller(CategorieController::class)->name('categories.')->prefix('categories')->group(function () {
		Route::get('liste', 'index')->name('index');
		Route::post('create-new', 'store')->name('store');
		Route::get('{categorie}/update-published', 'updatePublishedState')->name('update-published-state');
		Route::put('{categorie}/modifier', 'update')->name('update');
		Route::delete('{categorie}/supprimer', 'destroy')->name('delete');
	});

	Route::controller(SliderController::class)->name('sliders.')->prefix('sliders')->group(function () {
		Route::get('liste', 'index')->name('index');
		Route::get('ajouter', 'create')->name('create');
		Route::get('{slider}/modifier', 'edit')->name('edit');
		Route::post('', 'store')->name('store');
		Route::put('{slider}/modifier', 'update')->name('update');
		Route::delete('{slider}/supprimer', 'destroy')->name('delete');
	});

	Route::controller(MessageController::class)->name('messages.')->prefix('messages')->group(function () {
		Route::get('liste', 'index')->name('index');
		Route::delete('{message}/supprimer', 'destroy')->name('delete');
		Route::get('{slug}/read', 'read')->name('read');
	});

	Route::controller(UserController::class)->middleware('admin')->prefix('utilisateurs')->name('users.')->group(function () {
		Route::get('liste', 'index')->name('index');
		Route::post('ajouter', 'store')->name('store');
		Route::put('{user}/modifier', 'update')->name('update');
		Route::put('{user}/modifier-role', 'updateRole')->name('update-role');
		Route::delete('{user}/retirer', 'destroy')->name('delete');
	});
});

require __DIR__ . '/auth.php';
require __DIR__ . '/client.php';
