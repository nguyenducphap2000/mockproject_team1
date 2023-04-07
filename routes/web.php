<?php

use App\Http\Controllers\UpdateProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::view('/profile', 'profile')->name('profile');
    Route::put('/profile/{id}', [UpdateProfileController::class, 'update'])->name('update-profile');
});
Route::get('/', function () {
    return view('index');
});

Route::get('/cart', function () {
    return view('cart');
})->name('cart');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/overview', function () {
    return view('overview');
})->name('overview');

Route::get('/user-list', function () {
    return view('user-list');
})->name('user-list');

Route::get('/add-product', function () {
    return view('add-product');
})->name('add-product');

Route::get('/order', function () {
    return view('order');
})->name('order');

Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/products', function () {
    return view('products');
});
Route::get('/single-product', function () {
    return view('single-product');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
