<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kandang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email'=> 'unique:users,email',

        ], [
            'email.unique' => 'Email sudah terdaftar'
         ]);

         $image = $request->photo;  // your base64 encoded
         $imageName =  $request->get('name').time().'.jpeg';
         \File::put(public_path('storage/uploads/') . $imageName, base64_decode($image));

        $url = Storage::url(  $imageName);
        $peternak = new User([
                'name' => $request->get('name'),
                'role_id' => $request->get('role_id'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')) ,
                'address' => $request->get('address'),
                'telp' => $request->get('telp'),
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
                
                return response()->json("User Tidak Aktif", 401);
            }else{

                            
            $result = [
                "message" => "Sukses Login",
                "status" => true,
                "id" => $peternak->id,
                "nama" => $peternak->name,
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
}
