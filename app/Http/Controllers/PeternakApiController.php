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

        $cek = Panen::where('kandang_id', $request->field1)
            ->orderBy('id','desc')
            ->first();

        if($cek->berat_panen > $request->field4){
            $new = new Panen();
            $new->kandang_id = $request->field1;
            $new->berat_panen = $request->field4;
            $new->save();

            $aktivitas = new AktivitasKandang();
            $aktivitas->kandang_id = $request->field1;
            $aktivitas->aktivitas_id = 1;
            $aktivitas->save();

            // return response()->json(["status"=>"create","panen"=>$new]);
        }
        
        if($request->field4 == 0){
            $val = Panen::where('kandang_id', $request->field1)
            ->orderBy('id','desc')
            ->first();

            $val->berat_panen = $request->field4;
            $val->save();

            // return response()->json(["status"=>"update","panen"=>$panen]);
        }

        if($request->field4 > 0){
            $val = Panen::where('kandang_id', $request->field1)
            ->orderBy('id','desc')
            ->first();

            $val->berat_panen = $request->field4;
            $val->save();

            // return response()->json(["status"=>"update 2","panen"=>$panen]);
        }        
        
        $latitude = $request->field3;
        $longitude = $request->field2;

        $lokasi = LokasiKandang::where('kandang_id', $request->field1)->first();

        if($latitude == $lokasi->latitude || $lokasi == $lokasi->longitude ) {
            return response()->json(["status"=>"Tidak Update","panen update"=>$panen]);
        }
        
        else{
            $lokasi->latitude = $latitude;
            $lokasi->longitude = $longitude;
            $lokasi->save();

            $aktivitas2 = new AktivitasKandang();
            $aktivitas2->kandang_id = $request->field1;
            $aktivitas2->aktivitas_id = 4;
            $aktivitas2->save();

            return response()->json(["status"=>"Update","lokasi"=>$lokasi,"panen"=>$panen]);
        }

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
        $notif->berat_sarang = 2000;
        $notif->tanggal = date('Y-m-d H:i:s');
        $notif->save();
        
    
        return response()->json(["status"=>"berhasil","kandang"=>$data],201);
        }

        public function kandang(Request $request)
        {
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
                    if($input->foto && file_exists(storage_path('app/public/kandang/' .$input->foto))){
                        Storage::delete('public/kandang/'. $input->foto);
                        }
                    $images = 'kandang_photobaru'.time().'.'.$request->file('photo')->extension();
                    Image::make($new_photo)->resize(300, 300)->save(storage_path('app/public/kandang/' . $images));
                    $input->foto = $images;
                }

                $update->save();
            }
            return response()->json($update);
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

        $patokan = $last->berat_sarang * 0.8;
                

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

                if ($request->berat >= $patokan) {
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

    public function getAktivitas(Request $request){
     
        $aktivitas = new AktivitasKandang();
        $aktivitas->kandang_id = $request->field1;
        $aktivitas->aktivitas_id = $request->field2;
        
    }
}
