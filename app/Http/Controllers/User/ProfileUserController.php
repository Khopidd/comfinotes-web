<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function App\Helpers\path_view;

class ProfileUserController extends Controller
{
    public function profileUser(){
        $view = path_view('User.profile-user');
        return view($view);
    }
}
