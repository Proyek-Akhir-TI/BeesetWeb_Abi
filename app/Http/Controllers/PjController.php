<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Image;
use App\User;

class PjController extends Controller
{
    public function profil($id){
        $pj = User::find($id);

        return view('pj.profil', compact('pj'));
    }

    public function update($id){
        $this->validate($request, [
            'email' => [
                'required',
                Rule::unique('users')->ignore($id,'id')
            ],
        ]);

        $input = User::find($id);
        $input->nama = $request->nama;
        $input->alamat = $request->alamat;
        $input->telpon = $request->telpon;
        $new_photo = $request->file('photo');
        
        if($request->email){
            $input->email = $request->email;
        }

        if($request->password){
            $input->password = Hash::make($request->password);
        }

        if($new_photo){
            if($input->photo && file_exists(storage_path('app/public/uploads/' .$input->photo))){
                    Storage::delete('public/uploads/'. $input->photo);
                    }
            $images = 'user_photobaru'.time().'.'.$request->file('photo')->extension();
            Image::make($new_photo)->resize(300, 300)->save(storage_path('app/public/uploads/' . $images));
            $input->photo = $images;
        }

        $input->save();

        Alert::success('Data Berhasil Diupdate');

        return redirect()->route('pj.beranda');
    }
}
