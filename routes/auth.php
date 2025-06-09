<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\Auth\VerifController;
use Illuminate\Support\Facades\Route;

Route::controller( AuthController::class)->group(function(){
    Route::get('/', 'showLogin')->name('auth');
    Route::post('/login', 'signin')->name('login');
    Route::post('/logout', 'signout')->name('logout');

});

Route::get('/forgot-password', [ForgotController::class, 'forgot'])->name('forgot');
Route::get('/reset-password', [ResetController::class, 'reset'])->name('reset');
Route::get('/verifikasi-email', [VerifController::class, 'verif'])->name('verif');
