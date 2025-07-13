<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\TransactionModel;
use Illuminate\Http\Request;

class TransactionApprovalController extends Controller
{

    public function notifIndex()
{
    $notifications = TransactionModel::with('user.divisi')
        ->where('status', 'pending')
        ->latest()
        ->get();

    return view('admin.dashboard-admin', [
        'PageTitle' => 'Dashboard',
        'PageSubtitle' => 'Welcome Admin',
        'notifications' => $notifications
    ]);
}


    public function submit(Request $request)
    {
        $request->validate([
            'notif_id' => 'required|exists:transaction,id',
            'action'   => 'required|in:approved,rejected',
        ]);

        $trx = TransactionModel::findOrFail($request->notif_id);

        $trx->status = $request->action;

        if ($request->action == 'approved') {
            if ($request->filled('total_disetujui')) {
                $trx->total_disetujui = str_replace('.', '', $request->total_disetujui);
            } else {
                $trx->total_disetujui = $trx->total;
            }
        } else {
            $trx->total_disetujui = null;
        }

        $trx->save();

        return redirect()->back()->with('success', 'Pengajuan telah diperbarui.');
    }

}
