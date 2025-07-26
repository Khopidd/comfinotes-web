<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Models\User\TransactionModel;
use Illuminate\Http\Request;
use App\Helpers\helper as Helpers;
use App\Models\Admin\ComunityModel;
use App\Models\Auth\AuthModel;
use Illuminate\Support\Facades\Auth;

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

    public function detailTransaksi($key_id){
        $dataTransaction = ComunityModel::where('key_id', $key_id)->first();

        $detailTrasaction = TransactionModel::with('user.divisi')
        ->whereIn('user_id', AuthModel::where('divisi_id', $dataTransaction->id)->pluck('id'))
        ->orderBy('created_at', 'desc')->first();

        $view = path_view('admin.detail-transaksi');
        return view($view, compact('dataTransaction', 'detailTrasaction'));
    }


    public function userDashboard()
    {
        $userNotif = Auth::id();
        $notificationsUser = TransactionModel::where('user_id', $userNotif)
                        ->whereIn('status', ['approved', 'rejected'])
                        ->latest()
                        ->get();

    $notifications = TransactionModel::where('user_id', Auth::id())
    ->where('is_read', false)
    ->orderBy('created_at', 'desc')
    ->get();


        $view = Path_view('User.dashboard-user');
        return view($view, compact('notificationsUser', 'notifications'));
    }


}
