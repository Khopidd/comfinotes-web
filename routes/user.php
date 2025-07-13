<?php

use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware(['web', 'auth', 'role:user'])->group(function(){
    Route::get('/dashboard-user', [UserController::class, 'user'])->name('dashboard-user');
    Route::get('/Submission', [TransactionController::class, 'submission'])->name('tambah-pengajuan');
    Route::post('/pengajuan/store', [TransactionController::class, 'AddTransaction'])->name('transaction.store');
});
