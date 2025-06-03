<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard-user', [UserController::class, 'user'])->name('dashboard-user');
