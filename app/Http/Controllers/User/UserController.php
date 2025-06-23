<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\path_view;

class UserController extends Controller
{
    public function user(){

        $users = Auth::user();
        $divisi = $users->divisi;
        $view = path_view('User.dashboard-user');
        return view($view, compact('divisi'));
    }
}
