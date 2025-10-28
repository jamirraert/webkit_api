<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * @method POST
 * Authentication Route
 */
Route::controller(AuthController::class)
    ->name('auth.')
    ->group(function() {
        Route::post('/login', 'login')->name('login');
        Route::post('/register', 'register')->name('register');
        Route::post('/logout', 'logout')
        ->middleware('auth:sanctum')
        ->name('logout');
    });
