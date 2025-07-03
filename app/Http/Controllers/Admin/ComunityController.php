<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ComunityModel;
use Illuminate\Http\Request;

use function App\Helpers\path_view;

class ComunityController extends Controller
{
    public function comunity(){
        $divisi = ComunityModel::all();
        $comunity = AdminModel::all();

        $view = path_view('admin.community-admin');
        return view($view, compact('comunity', 'divisi'));
    }

    public function detail($key_id){
        $divisi = ComunityModel::where('key_id', $key_id)->firstOrFail();
        $datas = $divisi->comunite;
        $view = path_view('admin.detail-acount');
        return view($view, compact('divisi', 'datas'));
    }

}
