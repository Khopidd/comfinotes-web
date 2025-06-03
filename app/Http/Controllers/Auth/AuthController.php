<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.auth');
    }

    public function forgot(){
        return view('auth.forgot-password');
    }

    public function reset(){
        return view('auth.reset-password');
    }

    public function verif(){
        return view('auth.verif-email');
    }
}
