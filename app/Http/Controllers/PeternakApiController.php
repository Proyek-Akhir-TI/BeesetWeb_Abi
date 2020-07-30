<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kandang;
use App\Panen;
use App\Kelompok;
use App\LokasiKandang;
use App\AktivitasKandang;
use App\Notifikasi;
use App\Notif;
use Illuminate\Support\Facades\Storage;


class PeternakApiController extends Controller
{
    public function kelompok(){
        $kelompoks = Kelompok::where('id', '!=', 1)
            ->where('id','!=', 2)
            ->get();

    	return response()->json(["kel" => $kelompoks]);
    }

    public function getData(Request $request)
    {
        $panen = ([
            'kandang_id' => $request->field1,
            'berat_panen' => $request->field4,
            ]);
        
        $val = Panen::where('berat_panen', 0)
            ->where('kandang_id', $request->field1)
            ->orderBy('id','desc')
            ->first();
        
        $cek = Panen::where('kandang_id', $request->field1)
            ->orderBy('id','desc')
            ->first();
        
        $batas = $request->field4 > 2;

        $cek2 = Panen::where('berat_panen', $batas)
            ->where('kandang_id', $request->field1)
            ->orderBy('id','desc')
            ->first();

        return $batas;
        
        // $val2 = Panen::where('berat_panen' <= 2)
        //     ->where('kandang_id', $request->field1)
        //     ->orderBy('id','desc')
        //     ->first();

        // $val3 = Panen::where('berat_panen' >= 2)
        //     ->where('kandang_id', $request->field1)
        //     ->orderBy('id','desc')
        //     ->first();
        
        return $request->field4 <= 2;

        // return $cek;

        if($val){
            $val->berat_panen = $request->field4;
            $val->save();

            return response()->json(["status"=>"update","panen"=>$panen]);
        }        
        if($cek2){
            echo "Baa";  
        } 
        // $v = new Panen();
        //         $v->kandang_id = $request->field1;
        //         $v->berat_panen = 0; 
        //         $v->save();
    
        //         echo "cek2 simpan baru";   
        if($cek){
                $cek->berat_panen = $request->field4;
                $cek->save();

                // if($cek->berat_panen == 2){
                //     echo "Gak nyapo nyapo";
                // }
                // else{
                //     $kandang_id = Panen::create($panen)->kandang_id;
                //     return response()->json(["status"=>"buat","panen"=>$panen]);
                // }


                return response()->json(["status"=>"cek update","panen"=>$panen]);
        }





        // else if($cek){
        //     $cek->berat_panen = $request->field4;
        //     $cek->save();

        //     return response()->json(["status"=>"cek update","panen"=>$panen]);
        // }

       
       
        // else{
        //     $kandang_id = Panen::create($panen)->kandang_id;

        //     return response()->json(["status"=>"buat","panen"=>$panen]);
        // }

        // if($request->field4 == 0){
            

        //     return $val;
            
        //     if($val->berat_panen == 0){
        //         $val->berat_panen = $request->field4;
        //         $val->save();
        //     }  
        //     else{
        //         $kandang_id = Panen::create($panen)->kandang_id;
        //     }     
            
        // }
        // else if($request->field4 <= 2){
        //     $val->berat_panen = $request->field4;
        //     $val->save();
        // } 
        
        // $aktivitas = new AktivitasKandang();
        // $aktivitas->kandang_id = $kandang_id;
        // $aktivitas->aktivitas_id = 1;
        // $aktivitas->save();

        // $latitude = $request->field3;
        // $longitude = $request->field2;

        // $input = LokasiKandang::where('kandang_id', $kandang_id)->first();

        // if($latitude == $input->latitude || $longitude == $input->longitude ) {
        //     echo "0 0";
        // }
        // else if(Panen::create($panen)){
        //     echo "1 0";
        // }
        // else{
        //     $input->latitude = $latitude;
        //     $input->longitude = $longitude;
        //     $input->save();

        //     $aktivitas2 = new AktivitasKandang();
        //     $aktivitas2->kandang_id = $kandang_id;
        //     $aktivitas2->aktivitas_id = 4;
        //     $aktivitas2->save();

        //     echo "1 1";
        // }



        // return response()->json($panen);
    }

//Kandang

    public function tambahKandang(Request $request){

        $image = $request->foto;  // your base64 encoded
        $imageName =  $request->get('nama').time().'.jpeg';
         \File::put(public_path('storage/kandang/') . $imageName, base64_decode($image));
        $input = ([
            'nama' => $request->nama,
            'user_id' => $request->user_id,
            'url' => $request->url,
            'kelompok_id' => $request->kelompok_id,
            'foto' => $imageName,
        ]);

        $kandang_id = Kandang::create($input)->id;

        $data = Kandang::where('id', $kandang_id)->get();

        $panen = new Panen();
        $panen->kandang_id = $kandang_id;
        $panen->save();
    
        $lokasi = new LokasiKandang();
        $lokasi->kandang_id = $kandang_id;
        $lokasi->save();

        $notif = new Notifikasi();
        $notif->kandang_id = $kandang_id;
        $notif->berat_sarang = 2;
        $notif->tanggal = date('Y-m-d H:i:s');
        $notif->save();
        
    
        return response()->json(["status"=>"berhasil","kandang"=>$data],201);
        }

        public function kandang(Request $request)
    {
        // $kandang = Kandang::where('user_id', $request->user()->id)
        //             ->join('kandang', 'kandang.id','=','lokasi_kandang.kandang_id') 
        //             ->get();
        // // $kandang = Kandang::find($request->user()->id);
        $kandang = LokasiKandang::select('kandang.id as id', 'kandang.nama as nama', 'kandang.url as url','kandang.kelompok_id as kelompok_id','kandang.foto as foto', 'lokasi_kandang.latitude as latitude','lokasi_kandang.longitude as longitude')
                    ->join('kandang', 'kandang.id','=','lokasi_kandang.kandang_id')
                    ->where('kandang.user_id', $request->user()->id)
                    ->get();
        
        $hasil[]="";

        foreach($kandang as $val => $v ){
            
            $hasil[] = [
                "id" => $v->id,
                "nama" => $v->nama,
                "url" => $v->url,
                "kelompok_id" => $v->kelompok_id,
                "foto" => Storage::url('kandang/'. $v->foto),
                "latitude" => $v->latitude,
                "longitude" => $v->longitude,          
            ];
        }

        // foreach($lokasi as $value => $va ){
            
        //     $lok[] = [
        //         "kandang_id" => $va->kandang_id,
        //         "latitude" => $va->latitude,
        //         "longitude" => $va->longitude,        
        //     ];
        // }


        
        
        return response()->json( ['kandang' => $hasil] ,200);
    }
    
        public function updateKandang(Request $request)
        {
            $id = $request->id;
            $nama= $request->nama;
            $user_id = $request->user_id;
            $kelompok_id = $request->kelompok_id;
            $new_photo = $request->file('foto');

            $update = Kandang::where('id', $id);

            if($update){
                $update->nama = $nama;
                $update->user_id = $user_id;
                $update->kelompok_id = $kelompok_id;
                if($new_photo){
                    if($update->foto && file_exists(storage_path('app/public/kandang' .$update->foto))){
                    \Storage::delete('public/kandang'. $update->foto);
                    }
                    $new_photo_path = $new_photo->storeAs(
                        'public/kandang', 'kandang_photobaru'.time().'.'.$request->file('foto')->extension()
                    );
                    $update->foto = $new_photo_path;
                }

                $update->save();
            }
            return response()->json($update);
        }
        
    public function getLokasiKandang(Request $request)
    {
        $kandang_id = $request->kandang_id;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $input = LokasiKandang::where('kandang_id', $kandang_id)->first();

        if($latitude == $input->latitude || $longitude == $input->longitude ) {
            return response()->json("Gagal Update", 422);
        }
        else{
            $input->latitude = $request->latitude;
            $input->longitude = $request->longitude;
            $input->save();

            return response()->json("Update Berhasil", 201);
        }

    }

    public function notif(Request $request)
    {
        $id = $request->field1;
        $last = Notifikasi::where('kandang_id', $id)->orderBy('tanggal', 'desc')->first();
        $ambil_token = Kandang::select('users.api_firebase as token')
                                ->join('users','users.id','=','kandang.user_id')
                                ->where('kandang.id', $id)
                                ->first();
                
                $token = $ambil_token->token;
                

            if (date("Y-m-d H:I:s", strtotime($last->tanggal)) < date("Y-m-d H:I:s", strtotime('-30 minutes'))) {
                $data = Notifikasi::where('kandang_id', $id)->first();
                $data->tanggal = date('Y-m-d H:i:s');
                $data->save();

                $fcm = new Notif();

                $pesan = '';
                if ($request->suhu >= 32) {
                    $pesan = $pesan." Suhu kandang Panas";
                }

                if ($request->lembab >= 60) {
                    $pesan = $pesan." Suhu kandang terlalu lembab";
                }

                if ($request->berat == $last->berat_sarang) {
                    $pesan = $pesan." Kandang Siap Panen";
                    //tambahkan nama kandang kalo bisa
                }

                $judul = "Suhu Kandang";

                $gas = $fcm->suhu2($token, $judul, $pesan);
                
                return "succes";

            }
    
  
    }

    public function hapusKandang(Request $request){

        Kandang::where('id', $request->id)->delete();

        return response()->json("Hapus Berhasil");
    }
}
