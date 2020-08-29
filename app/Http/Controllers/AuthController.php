<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        $logintype = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'nama';

        $login = [
            $logintype => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($login)){
            
            if(auth()->user()->role_id == 1){
                Alert::success('Selamat datang Administrator');
                return redirect()->route('administrator.index');
            }
            elseif (auth()->user()->role_id == 2) {
                Alert::success('Selamat datang Penanggung Jawab');
                return redirect()->route('pj.beranda');
            }
            elseif (auth()->user()->role_id == 3) {
                Alert::success('Selamat datang Ketua Kelompok');
                return redirect()->route('ketua.index');
            }
        }
        Alert::error('Akun tidak ditemukan','Gagal');
        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('Kamu berhasil keluar', 'Selamat tinggal!');
        return redirect()->route('login');
    }
}
