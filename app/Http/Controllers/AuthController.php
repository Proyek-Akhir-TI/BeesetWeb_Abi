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
        $logintype = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $login = [
            $logintype => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($login)){
            
            if(auth()->user()->role_id == 1){
                Alert::success('Selamat datang Super User');
                return redirect()->route('administrator.kelompok');
            }
            elseif (auth()->user()->role_id == 2) {
                Alert::success('Selamat datang Penanggung Jawab');
                return redirect()->route('pj.highlight');
            }
            elseif (auth()->user()->role_id == 3) {
                Alert::success('Selamat datang Ketua Kelompok');
                return redirect()->route('ketua.konfirmasipeternak');
            }
        }
        SweetAlert::error('Akun tidak ditemukan','Gagal');
        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('Kamu berhasil keluar', 'Selamat tinggal!');
        return redirect()->route('login');
    }
}
