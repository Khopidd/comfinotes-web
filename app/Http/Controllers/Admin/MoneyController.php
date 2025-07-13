<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AddFunctModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\helper as Helpers;

use function App\Helpers\path_view;

class MoneyController extends Controller
{
    public function money(){
        $income = AddFunctModel::all();
        $totalIncome = AddFunctModel::sum('jumlah');
        $saldo = Helpers::getSaldo();
        $view = path_view('admin.add-money');
        return view($view, compact('income', 'totalIncome', 'saldo'));
    }

    public function Addfunds(Request $request){
        $validated = $request->validate([
            'keterangan' => 'string|max:150',
            'jumlah' => 'required|numeric|min:1000',
            'tanggal' => 'required|date'

        ], [
            'jumlah.required' => 'Tidak boleh kosong',
            'jumlah.numeric' => 'Input harus berupa Angka',
            'jumlah.min' => 'Transaksi Minimal RP. 1000',
            'tanggal.required' => 'tanggal tidak boleh kosong'
        ]);

        $money = new AddFunctModel();
        $money->created_by = Auth::id();
        $money->jumlah = $validated['jumlah'];
        $money->tanggal_masuk = $validated['tanggal'];
        $money->keterangan = $validated['keterangan'];
        $money->save();

        Helpers::tambahSaldo($validated['jumlah']);

        return redirect()->back()->with('success', 'Dana Berhasil ditambahkan');
    }
}
