<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'role:admin'])->group(function(){
    Route::get('/dashboard-admin', [AdminController::class, 'admin'])->name('dashboard-admin');
    Route::get('/community-admin', [AdminController::class, 'comunity'])->name('comunity-admin');
});

