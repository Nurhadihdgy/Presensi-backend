<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PresensiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/check-authentication-status', [AuthController::class, 'checkAuthenticationStatus']);
    Route::get('/user', [AuthController::class, 'getAuthenticatedUser']);
    Route::post('/presensi', [PresensiController::class, 'presensi']);
    Route::get('/data_presensi_user', [PresensiController::class, 'getUserAttendance']);
});
