<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ComunityController;
use App\Models\Admin\ComunityModel;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'role:admin'])->group(function(){
    Route::get('/dashboard-admin', [AdminController::class, 'admin'])->name('dashboard-admin');
    Route::get('/community-admin', [ComunityController::class, 'comunity'])->name('comunity-admin');

    Route::get('/admin/detail/{key_id}', [ComunityController::class, 'detail'])->name('admin.detail-user');
});

