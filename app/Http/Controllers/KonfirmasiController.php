<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use App\Notif;
use DB;
use Image;	
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KonfirmasiController extends Controller
{
    public function updateUser(Request $request, $id){
         $this->validate($request, [
            'email' => [
                'required',
                Rule::unique('users')->ignore($id,'id')
            ],
        ]);

        $input = User::find($id);
        $input->status = $request->status;
        $input->save();

        $notif = new Notif();
        $token = $input->api_firebase;

        $pesan = 'Akun Beeset Anda Aktif';
       
        $judul = $input->nama;
        $notif->suhu2($token, $judul, $pesan);

        return redirect()->route('ketua.listpeternak');
    }

    public function tolak($id){
        $peternak = User::find($id);

        $notif = new Notif();
        $token = $peternak->api_firebase;

        $pesan = 'Akun Beeset Anda Ditolak';
       
        $judul = $pternak->nama;
        $notif->suhu2($token, $judul, $pesan);

        $peternak->delete();
        
        Alert::error('Peternak Sudah Dihapus', 'Hapus Berhasil');

        return redirect()->route('ketua.listpeternak');
    }
}
