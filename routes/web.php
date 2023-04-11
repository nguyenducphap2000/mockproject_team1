<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ProductController;
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

Route::middleware(['auth', 'authadmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/overview', [ManageUserController::class, 'index'])->name('overview');

        Route::prefix('manage-user')->group(function () {
            Route::get('/user-list', [ManageUserController::class, 'listOfUser'])->name('user-list');
            Route::post('/user-disable', [ManageUserController::class, 'disableUser'])->name('user-disable');
            Route::post('/toggle-disable', [ManageUserController::class, 'toggleDisableUser'])->name('toggle-disable');
            Route::post('/update-user', [ManageUserController::class, 'updateUser'])->name('update-user');
            Route::get('/search-user', [ManageUserController::class, 'searchUser'])->name('search-user');
        });

        Route::prefix('manage-product')->group(function () {
            Route::get('/product-list', [ProductController::class, 'index'])->name('product-list');
            Route::get('/add-product', [ProductController::class, 'indexForm'])->name('add-product');
            Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('store-product');
            Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');
            Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update-product');
            Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('search-product');
        });
    });

    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');

    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');

    Route::get('/order', function () {
        return view('order');
    })->name('order');

});

Route::middleware(['auth', 'authdisable'])->group(function () {
    Route::put('/profile/{id}', [UpdateProfileController::class, 'update'])->name('update-profile');
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');
    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');
    Route::get('/order', function () {
        return view('order');
    })->name('order');
    Route::get('/profile-form', function () {
        return view('profile-form');
    })->name('profile-form');
});
Route::get('/single-product/{id}', [ProductController::class, 'getProductById'])->name('single-product');

Route::get('/products', [ProductController::class, 'showProduct'])->name('showProduct');
Route::get('/products/filter', [ProductController::class, 'filterProduct'])->name('filterProduct');

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::view('/about', 'about');
Route::view('/contact', 'contact');

Auth::routes();
// Route::get('/single-product', function () {
//     return view('single-product');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
