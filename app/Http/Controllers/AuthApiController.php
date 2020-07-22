<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kandang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email'=> 'unique:users,email',

        ], [
            'email.unique' => 'Email sudah terdaftar'
         ]);

         $image = $request->photo;  // your base64 encoded
         $imageName =  $request->get('telpon').time().'.jpeg';
         \File::put(public_path('storage/uploads/') . $imageName, base64_decode($image));

        $url = Storage::url('uploads/'. $imageName);
        $peternak = new User([
                'nama' => $request->get('nama'),
                'role_id' => $request->get('role_id'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')) ,
                'alamat' => $request->get('alamat'),
                'telpon' => $request->get('telpon'),
                'kelompok_id' => $request->get('kelompok_id'),
                'photo' => $imageName,
                'api_token' => Str::random(64),
                'status' => $request->get('status')

                ]);
        $peternak->save();

        if ($peternak !=null) {
            $pesan = [
                        "message" => "Daftar Berhasil",
                        "error" => false,
                        "Token" => $peternak->api_token,
                        "url" =>   $url
                    ];
                     return response()->json($pesan,201);
        } else {
            $pesan = [
                        "message" => "Daftar Gagal",
                        "error" => true
                    ];
        }
        return response()->json($pesan,422);
       
    }

    public function login(Request $request)
    {
        $email =  $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $peternak = User::where('email', $email)->first();
           
            if ( $peternak->status == 0) { 
                
                return response()->json("User Tidak Aktif", 200);
            }else{

                            
            $result = [
                "message" => "Sukses Login",
                "status" => true,
                "id" => $peternak->id,
                "nama" => $peternak->nama,
                "email" => $peternak->email,
                "token" => $peternak->api_token,
                "kelompok_id" => $peternak->kelompok_id,
                "images" => Storage::url('uploads/'. $peternak->photo),
               
              
            ];
         return response()->json( $result,200);
            }
           
        } 
        return response()->json("Login Gagal", 401);
    }

    public function reset(Request $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $telpon = $request->telpon;

        $user = User::where('nama', $nama)
            ->where('email', $email)
            ->where('telpon', $telpon)
            ->first();

        if($user){
            $user['password'] = Hash::make($request->password);
            $user->save();

            return response()->json(201);
        }
        else{
            return response()->json("Pengguna Tidak Ditemukan, Reset Gagal", 422);
        }    
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $email = $request->email;
        $password = $request->password;
        $telpon = $request->telpon;
        $alamat = $request->alamat;
        $new_photo = $request->file('photo');

        $peternak = User::where('id', $id)->first();

        if($peternak){
            $peternak->nama = $nama;
            $peternak->email = $email;
            $peternak->telpon = $telpon;
            $peternak->alamat = $alamat;

            if($password){
                $peternak->password = Hash::make($password);
            }
            
            if($new_photo){
                if($peternak->photo && file_exists(storage_path('app/public/uploads' .$peternak->photo))){
                    \Storage::delete('public/uploads'. $input->photo);
                    }
                $new_photo_path = $new_photo->storeAs(
                        'public/uploads', 'peternak_photobaru'.time().'.'.$request->file('photo')->extension()
                    );
                $peternak->photo = $new_photo_path;
            }

            $peternak->save();

        }
    }

    public function firebase(Request $request){
        $id = $request->id; 
        $firebase = $request->firebase;

        $user = User::where('id', $id)->first();

        if($firebase != $user['api_firebase']){
            $user->api_firebase = $firebase;
            $user->save();
        }
            
    }

    public function profile(Request $request)
    {

        return $request->user();
    }


}
