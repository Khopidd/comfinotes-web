<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ComunityController;
use App\Http\Controllers\Admin\MoneyController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TransactionApprovalController;
use App\Http\Controllers\User\TransactionController;
use App\Models\Admin\ComunityModel;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'role:admin'])->group(function(){
    Route::get('/dashboard-admin', [AdminController::class, 'admin'])->name('dashboard-admin');
    Route::get('/dashboard/add-money', [MoneyController::class, 'money'])->name('money.view');
    Route::post('/dashboard/addFunds', [MoneyController::class, 'Addfunds'])->name('admin.addfunds');

    Route::get('/community-admin', [ComunityController::class, 'comunity'])->name('comunity-admin');
    Route::get('/admin/detail/{key_id}', [ComunityController::class, 'detail'])->name('admin.detail-user');
    Route::post('/admin/add/group', [ComunityController::class, 'AddGroup'])->name('admin.add-group');
    Route::post('/admin/delete/{id}', [ComunityController::class, 'deleteGroup'])->name('admin.delete.group');

    Route::get('/admin/notif', [TransactionApprovalController::class, 'notifIndex'])->name('admin.notif');
    Route::post('/admin/notif/submit', [TransactionApprovalController::class, 'submit'])->name('notif.submit');

    Route::get('/profile/admin', [ProfileController::class, 'profile'])->name('admin.profile-admin');

});

