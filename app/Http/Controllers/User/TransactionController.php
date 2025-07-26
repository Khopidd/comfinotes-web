<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\AddFunctModel;
use App\Models\User\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use function App\Helpers\path_view;

class TransactionController extends Controller
{
    public function submission(){

        $view = path_view('User.Submission');
        return view($view);
    }

    public function AddTransaction(Request $request){
        $request->validate([
        'nama_acara' => 'required|string|min:3',
        'total' => 'required|numeric|min:1000',
        'catatan' => 'nullable|string|min:50',
        'supporting_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'jumlah_hari' => 'nullable|integer|min:1',
        'tanggal_pengajuan' => 'required|date',
        'tanggal_akhir' => 'nullable|date',
    ], [
        'nama_acara.required' => 'Nama Kegiatan Wajib diisi',
        'total.required' => 'Nominal wajib di isi',
        'total.numeric' => 'Harus berupa angka',
        'tanggal_pengajuan.required' => 'Tanggal wajib di isi',
        'jumlah_hari.required' => 'Sertakan jumlah hari untuk Acara',
        'supporting_image.image' => 'File harus berupa Gambar',
        'catatan.min' => 'Catatan Minimal 50 Karakter'
    ]);

    $tanggalAwal = Carbon::parse($request->tanggal_pengajuan);
    $tanggalAkhir = $tanggalAwal->copy()->addDays($request->jumlah_hari - 1);

    $imagePath = null;
        if ($request->hasFile('supporting_image')) {
        $imageGroup = time().'.'.$request->file('supporting_image')->getClientOriginalExtension();
        $request->file('supporting_image')->move(public_path('uploads/'), $imageGroup);
        $imagePath = $imageGroup;
    }


    TransactionModel::create([
        'user_id'           => Auth::id(),
        'divisi_id'         => Auth::user()->divisi_id,
        'total'             => $request->total,
        'nama_acara'        => $request->nama_acara,
        'tanggal_pengajuan' => $tanggalAwal,
        'tanggal_akhir'     => $tanggalAkhir,
        'jumlah_hari'       => $request->jumlah_hari,
        'catatan'           => $request->catatan,
        'supporting_image'  => $imagePath,
        'status'            => 'pending',
    ]);

    return redirect()->route('dashboard-user')->with('success', 'Pengajuan berhasil dikirim');
    }
}
