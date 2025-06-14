<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use Illuminate\Http\Request;

use function App\Helpers\path_view;

class ComunityController extends Controller
{
    public function comunity(){
        $comunity = AdminModel::all();
        $view = path_view('Admin.community-admin');
        return view($view, compact('comunity'));
    }
}
