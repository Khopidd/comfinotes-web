<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\AuthModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.auth');
    }


    public function signin(Request $request){
        $cridentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $remember = $request->filled('remember');

        $Auth = AuthModel::where('email', $cridentials['email'])->first();

        if(!$Auth){
            return back()->withErrors([
                'email' => 'Email Anda belum terdaftar'
            ])->withInput();
        }

        if($Auth->role == 'user' && is_null($Auth->divisi_id)){
            return back()->withErrors([
                'email' => 'Akun Anda sudah tidak Aktif'
            ]);
        }

        if (!Hash::check($cridentials['password'], $Auth->password)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukan salah!'
            ])->withInput();
        }

        if (Auth::attempt($cridentials,  $remember)) {
            $request->session()->regenerate();
            $role = $Auth->role;

            session()->flash('success', 'Halo ' . $Auth->username . ', selamat datang kembali!');

            return match ($role) {
                'admin' => redirect()->route('dashboard-admin'),
                'user' => redirect()->route('dashboard-user'),
                default => back()->withErrors(['email' => 'Role tidak dikenali.']),
            };

        } else {

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();

        }
    }

    public function signout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('success', 'Anda berhasil logout!');

        return redirect()->route('auth');
    }

}
