<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function App\Helpers\path_view;

class AdminController extends Controller
{
    public function admin(){
        $view = path_view('admin.dashboard-admin');
        return view($view);
    }
}
