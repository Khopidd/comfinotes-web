<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller( AuthController::class)->group(function(){
    Route::get('/', [AuthController::class, 'showLogin'])->name('auth');
    Route::get('/forgot-password', [AuthController::class, 'forgot'])->name('forgot');
    Route::get('/reset-password', [AuthController::class, 'reset'])->name('reset');
    Route::get('/verifikasi-email', [AuthController::class, 'verif'])->name('verif');
});
