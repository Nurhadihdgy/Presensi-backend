<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterViewController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PageOneController;
use App\Http\Controllers\AuthController;





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

Route::get('/register', [RegisterViewController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);
Route::get('/page-one', [PageOneController::class, 'showPageOne'])->name('page.one');
Route::post('/logout', [PageOneController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');