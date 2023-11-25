<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); 
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   
Route::resource('users', UserController::class);
Route::resource('events', EventController::class);
Route::resource('bookings', BookingController::class);
Route::resource('orders', OrderController::class);
Route::resource('products', ProductController::class)->parameters([
    'products' => 'product'
]);
Route::resource('payments', PaymentController::class);
Route::resource('pays', PayController::class);
