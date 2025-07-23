<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Models\User\TransactionModel;
use Illuminate\Http\Request;
use App\Helpers\helper as Helpers;

use function App\Helpers\path_view;

class TransactionApprovalController extends Controller
{

    public function notifIndex()
    {
        $notifications = TransactionModel::with('user.divisi')
            ->where('status', 'pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->get();

        $view = path_view('admin.dashboard-admin');
        return view($view, compact('notifications'));
    }


    public function submit(Request $request)
    {
        $request->validate([
            'notif_id' => 'required|exists:transaction,id',
            'action'   => 'required|in:approved,rejected',
        ]);

    $transfer = TransactionModel::findOrFail($request->notif_id);
    $transfer->status = $request->action;

    if ($request->action == 'approved') {
        if ($request->filled('total_disetujui')) {
            $jumlahDisetujui = str_replace('.', '', $request->total_disetujui);
            $transfer->total_disetujui = $jumlahDisetujui;
        } else {
            $jumlahDisetujui = $transfer->total;
            $transfer->total_disetujui = $jumlahDisetujui;

        }

        if (Helpers::getSaldo() < $jumlahDisetujui) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi untuk menyetujui transaksi ini.');
        }
            Helpers::kurangiSaldo($jumlahDisetujui);

        } else {
            $transfer->total_disetujui = null;
        }

        $transfer->save();

        return redirect()->back()->with('success', 'Status Pengajuan telah diperbarui.');
    }

}
