<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auth\AuthModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

use function App\Helpers\path_view;

class ProfileController extends Controller
{
    public function profile(){
        $profileAdmin = AuthModel::where('role', 'admin')->firstOrFail();
        $view = path_view('admin.profile-admin');
        return view($view, compact('profileAdmin'));
    }
    

}
