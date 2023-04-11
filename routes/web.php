<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\OrderController;
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
    Route::get('/overview', [DashBoardController::class, 'index'])->name('overview');

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

    Route::prefix('manage-order')->group(function () {
        Route::get('/order/accept/{id}', [OrderController::class, 'acceptOrder'])->name('orderAccept');
        Route::get('/order/checked/{id}', [OrderController::class, 'checkedOrder'])->name('checkedOrder');
        Route::delete('/order/delete', [OrderController::class, 'deleteOrder'])->name('deleteOrder');
    });
});

Route::middleware(['auth', 'authdisable'])->group(function () {
    Route::prefix('manage-order')->group(function () {
        Route::get('/order', [OrderController::class, 'index'])->name('order');
        Route::get('/order/show/{id}', [OrderController::class, 'show'])->name('orderShow');
        Route::get('/order/search', [OrderController::class, 'search'])->name('orderSearch');
    });

    Route::prefix('manage-cart')->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/store', [CartController::class, 'store'])->name('cartStore');
        Route::post('/cart/store-in-detail', [CartController::class, 'storeInDetail'])->name('cartStoreInDetail');
        Route::get('/cart/delete/{id}', [CartController::class, 'delete'])->name('cartDelete');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/store', [CartController::class, 'checkoutStore'])->name('checkoutStore');
    });

    Route::put('/profile/{id}', [UpdateProfileController::class, 'update'])->name('update-profile');
    Route::get('/profile-form', function () {
        return view('profile-form');
    })->name('profile-form');
});

Route::get('/products', [ProductController::class, 'showProduct'])->name('showProduct');
Route::get('/products/filter', [ProductController::class, 'filterProduct'])->name('filterProduct');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::get('/single-product/{id}', [ProductController::class, 'singleProduct'])->name('singleProduct');
Route::get('/faq', function () {
    return view('faq');
})->name('faq');
Auth::routes();
// Route::get('/single-product', function () {
//     return view('single-product');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
