<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactEditController;
use App\Http\Controllers\ServiceEditController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutEditController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductsEditController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsEditController;
use App\Http\Controllers\MediaEditController;

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/index-edit', [IndexController::class, 'index'])->name('index-edit');
    Route::post('/index-update', [IndexController::class, 'update'])->name('index-update');

    Route::get('/service-edit', [ServiceEditController::class, 'index'])->name('service.edit');
    Route::post('/service-edit', [ServiceEditController::class, 'update'])->name('service.update');

    Route::get('/about-edit', [AboutEditController::class, 'index'])->name('about.edit');
    Route::post('/about-edit', [AboutEditController::class, 'update'])->name('about.update');

    Route::get('/contact-edit', [ContactEditController::class, 'index'])->name('contact.edit');
    Route::post('/contact-edit', [ContactEditController::class, 'update'])->name('contact.update');

    Route::get('/products-edit', [ProductsEditController::class, 'index'])->name('products.edit');
    Route::post('/products-edit', [ProductsEditController::class, 'update'])->name('products.update');

    Route::get('/news-edit', [NewsEditController::class, 'index'])->name('news.edit');
    Route::post('/news-edit', [NewsEditController::class, 'update'])->name('news.update');

    Route::get('/media-edit', [MediaEditController::class, 'index'])->name('media.edit');
    Route::post('/media-edit', [MediaEditController::class, 'update'])->name('media.update');
});
