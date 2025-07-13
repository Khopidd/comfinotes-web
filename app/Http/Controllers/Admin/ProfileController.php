<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function App\Helpers\path_view;

class ProfileController extends Controller
{
    public function profile(){
        $view = path_view('admin.profile-admin');
        return view($view);
    }
}
