<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditController;

//

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tienda', function () {
    return view('tienda');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::apiresource('/productos', ProductosController::class);

// Cart Routes
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/cart/content', [CartController::class, 'getContent']);
Route::post('/cart/total', [CartController::class, 'getTotalCart']);
Route::get('/cart/clear', [CartController::class, 'clearCart']);
Route::get('/cart/info', [CartController::class, 'getCartInfo']);
Route::post('/cart/add', [CartController::class, 'addProduct']);
Route::get('/cart/remove/{id}', [CartController::class, 'removeProduct']);
Route::post('/cart/addq', [CartController::class, 'addQantity']);
Route::get('/shippings/{order_id}&{product_id}', [ShippingController::class, 'getQuantity'])->middleware('auth');
Route::get('/shippings/{order_id}', [ShippingController::class, 'getContent'])->middleware('auth');
Route::post('/shippings', [ShippingController::class, 'store']);

//Mails
Route::post('/cart/make', [CartController::class, 'makeOrder']);
Route::post('/inbox', [CartController::class, 'sendInbox']);

// Admin

Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth');

// Admin - Products
Route::get('/admin/productos', function () {
    return view('/admin/productos');
})->middleware('auth');
Route::get('/productos/active/{product_id}&{value}', [ ProductosController::class, 'active'])->name('admin');

// Admin - Orders
Route::get('/admin/ordenes', function () {
    return view('/admin/ordenes');
})->middleware('auth');
Route::get('/admin/orders', [OrderController::class, 'index'])->middleware('auth');
Route::post('/admin/orders', [OrderController::class, 'store']);

// Admin - Users

Route::get('/admin/users', function () {
    return view('/admin/users');
})->middleware('admin');
Route::apiresource('/users', UserController::class )->except([
    'create', 'store', 'show'
])->middleware('admin');

// Admin - Audit

Route::get('/admin/audit', function () {
    return view('/admin/audit');
})->middleware('admin');
Route::get('/audit', [AuditController::class, 'index'])->middleware('admin');
Route::post('/audit', [AuditController::class, 'store'])->middleware('auth');

// Authenthificacion

//Auth::routes();

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Login nd Logout routes

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
