<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use DB;
use Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class AdministratorController extends Controller
{
	

    public function tambahUser(){
    	$roles = Role::pluck('nama','id');
        $kelompoks = Kelompok::all();

    	return view('administrator.tambahuser', compact('roles','kelompoks'));
    }

    public function buatUser(Request $request)
    {
        $this->validate($request, [
            'email'  => 'required|unique:users',
        ]);

    	$input = new User();
        $input['nama'] = $request->nama;
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['role_id'] = $request->role_id;
        $input['kelompok_id'] = $request->kelompok_id;
        $input['alamat'] = $request->alamat;
        $input['telpon'] = $request->telpon;
        if($request->file('photo')){
            $image = $request->file('photo');
            $images = 'user_photo'.$request->telp.'.'.$request->file('photo')->extension();
            Image::make($image)->resize(300, 300)->save(storage_path('app/public/uploads/' . $images));
            $input['photo'] = $images;
            $images = $request->photo;
        }
        $input['status'] = 1;
        $input->save();

        Alert::success('User Berhasil Dibuat');

        return redirect()->route('administrator.tambahuser');
    }

    public function tambahKelompok(){
    	
    	return view('administrator.kelompok');
    }

    public function buatKelompok(Request $request){
    	DB::table('kelompok')->insert([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'user_id' => $request->user_id
        ]);

        Alert::success('Kelompok Berhasil Dibuat');
        
        return redirect()->route('administrator.kelompok');
    }
}
