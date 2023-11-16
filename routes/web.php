<?php

use Illuminate\Support\Facades\Route;

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
// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->middleware('guest');
// Route::post('/register', 'Auth\RegisterController@register')->middleware('guest'); 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 