<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AddFunctModel;
use App\Models\Admin\OutFunctModel;
use App\Models\User\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\path_view;

class AdminController extends Controller
{
    public function admin(){
        $totalIncome = AddFunctModel::sum('jumlah');
        $totalExpenses = OutFunctModel::sum('jumlah');
        $historyTransaction = TransactionModel::all();
        $totalAprovalTransaction = TransactionModel::where('status', 'approved')->sum('total_disetujui');
        $aprroveCount = TransactionModel::where('status', 'approved')->count();

        $resultTransaction = $totalIncome - ($totalExpenses + $totalAprovalTransaction);

        $view = path_view('admin.dashboard-admin');
        return view($view, compact('totalIncome', 'totalExpenses', 'totalAprovalTransaction', 'aprroveCount', 'resultTransaction', 'historyTransaction'));
    }

    public function AddFunds(Request $request){
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
        $money->jumlaj = $validated['jumlah'];
        $money->tanggal_transaksi = $validated['tanggal'];
        $money->keterangan = $validated['keterangan'];
        $money->save();

        return redirect()->back()->with('success', 'Dana Berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = TransactionModel::with('user.divisi')->findOrFail($id);
        return response()->json($data);
    }


    public function showNotifications()
    {
        $pendingTransactions = TransactionModel::where('status', 'pending')->latest()->get();
        return response()->json($pendingTransactions);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);

        $trx = TransactionModel::findOrFail($id);
        $trx->status = $request->status;

        if ($request->status == 'approved') {
            $trx->total_disetujui = $trx->total;
        }

        $trx->save();

        return response()->json(['message' => 'Status updated & notifikasi dikirim ke user']);
    }

}
