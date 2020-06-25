<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Kelompok;
use DB;
use Image;	
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KonfirmasiController extends Controller
{
	public function userToConfirm(Request $request){
		$this->validate($request, [
            'email'  => 'required|unique:users',
        ]);

    	$input = new User();
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = $request->password;
        $input['role_id'] = $request->role_id;
        $input['kelompok_id'] = $request->kelompok_id;
        $input['address'] = $request->address;
        $input['telp'] = $request->telp;
        if($request->file('photo')){
            $image = $request->file('photo');
            $images = 'user_photo'.$request->telp.'.'.$request->file('photo')->extension();
            Image::make($image)->resize(300, 300)->save(storage_path('app/public/uploads/' . $images));
            $input['photo'] = $images;
            $images = $request->photo;
        }
        $input->save();

        // SweetAlert::message('Message','Kelompok Berhasil Dibuat');

        	return redirect('/administrator/index');
	}
    public function updateUser(Request $request, $id){
         $this->validate($request, [
            'email' => [
                'required',
                Rule::unique('users')->ignore($id,'id')
            ],
        ]);

        $input = User::find($id);
        $input->name = $request->name;
        $input->email = $request->email;
        $input->password = Hash::make($request->password);
        $input->role_id = $request->role_id;
        $input->kelompok_id = $request->kelompok_id;
        $input->address = $request->address;
        $input->telp = $request->telp;
        $new_photo = $request->file('photo');
        if($new_photo){
            if($input->photo && file_exists(storage_path('app/public/uploads' .$input->photo))){
                \Storage::delete('public/uploads'. $input->photo);
            }
            $new_photo_path = $new_photo->storeAs(
                'user_photobaru', $request->telp.'.'.$request->file('photo')->extension()
            );
            $input->photo = $new_photo_path;
        }
        $input->status = $request->status;
        $input->save();

        return redirect('/ketua/listpeternak');
    }
}
