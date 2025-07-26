<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ComunityModel;
use App\Models\Auth\AuthModel;
use App\Models\User\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function App\Helpers\path_view;

class ComunityController extends Controller
{
    public function comunity(){
        $divisi = ComunityModel::all();
        $auth = AuthModel::all();
        $comunity = AdminModel::all();

        $view = path_view('admin.community-admin');
        return view($view, compact('comunity', 'divisi'));
    }

    public function detail($key_id){
        $divisi = ComunityModel::where('key_id', $key_id)->firstOrFail();
        $datas = $divisi->comunite;

        $transactions = TransactionModel::with('user.divisi')
        ->whereIn('user_id', AuthModel::where('divisi_id', $divisi->id)->pluck('id'))
        ->orderBy('created_at', 'desc')
        ->get();

        $userApprove = TransactionModel::where('status', 'approved')
        ->whereIn('user_id', AuthModel::where('divisi_id', $divisi->id)->pluck('id'))
        ->sum('total_disetujui');
        $view = path_view('admin.detail-acount');
        return view($view, compact('divisi', 'datas', 'transactions', 'userApprove'));
    }

    public function AddGroup(Request $request){
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ],[
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB',
            'image.image' => 'File yang diupliad berbebentu gambar',
            'image.mimes' => 'Format yang Anda masukan salah',
            'username.required' => 'Username tidak boleh kosong',
            'username.max' => 'Tidak boleh lebih dari 100 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email yang Anda masukan sudah tersedia',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password tidak boleh kurang dari 8 karakter'
        ]);


        $divisi = new ComunityModel();
        $divisi->name_divisi = $validated['username'];
        if($request->hasFile('image')){
            $imageGroup = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/'), $imageGroup);
            $divisi->image_divisi = $imageGroup;
        }

        $divisi->key_id = Str::slug($validated['username']);
        $divisi->save();

        $acount = new AuthModel();
        $acount->username = $validated['username'];
        $acount->email = $validated['email'];
        $acount->password = Hash::make($validated['password']);
        $acount->image = $divisi->image_divisi;
        $acount->role = 'user';
        $acount->divisi_id = $divisi->id;
        $acount->save();

        return redirect()->back()->with('success', 'Group Berhasil dibuat');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'username' => 'required|max:100',
            'password' => 'nullable|min:8',
            'image_profile' => 'nullable|mimes:jpeg,png,jpg|image|max:2048'
        ],[
            'username.required' => 'Username baru wajib di isi',
            'username.max' => 'Username maksimal 100 karakter',
            'password.min' => 'Password minimal 8 karakter',
            'image_profile.image' => 'File harus berupa gambar',
            'image_profile.mimes' => 'Format Harus : jpeg, jpg dan png'
        ]);

        $profile = AuthModel::where('role', 'admin')->first();

        if (!$profile) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        $profile->username = $request->username;

        if ($request->filled('password')) {
            $profile->password = Hash::make($request->password);
        }

        if ($request->hasFile('image_profile')) {
            $imageProfile = time().'.'.$request->image_profile->extension();
            $request->image_profile->move(public_path('uploads/'), $imageProfile);
            $profile->image = $imageProfile;
        }

        $profile->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }


    public function deleteGroup($id){
        $group = AuthModel::find($id);
        if (!$group) {
            return back()->withErrors(['error' => 'User tidak ditemukan.']);
        }

        $divisi = $group->divisi;
        $divisi->delete();

        if ($divisi && $divisi->comunite()->count() === 0) {
            if ($divisi->image_divisi && File::exists(public_path('uploads/' . $divisi->image_divisi))) {
                File::delete(public_path('uploads/' . $divisi->image_divisi));
            }

            $deletedGroup = $divisi->name_divisi;
            $divisi->delete();

            return redirect()->route('comunity-admin')->with('success', 'Divisi ' . $deletedGroup . ' berhasil dihapus.');
        }
    }



}
