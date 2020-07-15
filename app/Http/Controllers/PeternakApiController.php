<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kandang;
use App\Panen;
use App\Kelompok;
use App\LokasiKandang;
use App\AktivitasKandang;


class PeternakApiController extends Controller
{
    public function users(User $user)
    {
    	$users = $user->all();

    	return response()->json($users);
    }

    public function kandang(Request $request)
    {
    	$kandang = Kandang::where('user_id',$request->user()->id)->get();
        return response()->json( ['kandang' => $kandang] ,200);
    }

    public function kelompok(){
        $kelompoks = Kelompok::where('id', '!=', 1)
            ->where('id','!=', 2)
            ->get();

    	return response()->json(["kel" => $kelompoks]);
    }

    public function  inputaktivitas(){
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_URL, 'https://api.thingspeak.com/channels/1085076/feeds.json?api_key=R28BW9NXV8RGGCQ6&results=1000'); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
            $result = curl_exec($curl); 
            curl_close($curl);      

            $result = json_decode($result, true);
            
            dd($result);
    }

    public function notifSuhu()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n  \"to\": \"dMaMU3-cTA2eAlsX-Cmc_t:APA91bHNsLDKpQUBfHO3QuHZaPnUUBRDlyQAv9gDChJV7t5WFN2dYVE-lOC145D6hVJV8GxWplA4sMrhmra5al1HHGHb3UXmYe6pnY7JNApS4my6uCDqGVdqxfMY5nbhwPYA3Ms-Nwvj\",\r\n  \"notification\": {\r\n    \"body\": \"Suhu Kandang Panas\",\r\n    \"title\": \"Suhu Kandang BeeSet.\"\r\n  }\r\n}",
            CURLOPT_HTTPHEADER => array("Authorization: key=AAAAIOJWNzc:APA91bEhCJVpG-1W2_VvnjYtcpehs6whqIYlLWYtY1A6RDgL5Vmrol9o-zovflnQry9ps7ajqk4RcC_lSC2E6_ffMMnir7MFXCFio2LtA7NKzkGURAcwjRkOGfDLHQ379LTnngJM6dQ3","Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       
        $data = json_decode($response);
        $sukses = $data->success;
        if ($sukses == 1) {
      
        $pesan = "Sukses mengirim Notif";
        }else {
            $pesan = "Gagal Mengirim Notif";
        }

         return response()->json($pesan);
    }
    public function notifKelembapan()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n  \"to\": \"dMaMU3-cTA2eAlsX-Cmc_t:APA91bHNsLDKpQUBfHO3QuHZaPnUUBRDlyQAv9gDChJV7t5WFN2dYVE-lOC145D6hVJV8GxWplA4sMrhmra5al1HHGHb3UXmYe6pnY7JNApS4my6uCDqGVdqxfMY5nbhwPYA3Ms-Nwvj\",\r\n  \"notification\": {\r\n    \"body\": \"Suhu Kandang Panas\",\r\n    \"title\": \"Suhu Kandang BeeSet.\"\r\n  }\r\n}",
            CURLOPT_HTTPHEADER => array("Authorization: key=AAAAIOJWNzc:APA91bEhCJVpG-1W2_VvnjYtcpehs6whqIYlLWYtY1A6RDgL5Vmrol9o-zovflnQry9ps7ajqk4RcC_lSC2E6_ffMMnir7MFXCFio2LtA7NKzkGURAcwjRkOGfDLHQ379LTnngJM6dQ3","Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       
        $data = json_decode($response);
        $sukses = $data->success;
        if ($sukses == 1) {
      
        $pesan = "Sukses mengirim Notif";
        }else {
            $pesan = "Gagal Mengirim Notif";
        }

         return response()->json($pesan);
    }
    public function notifPanen()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n  \"to\": \"dMaMU3-cTA2eAlsX-Cmc_t:APA91bHNsLDKpQUBfHO3QuHZaPnUUBRDlyQAv9gDChJV7t5WFN2dYVE-lOC145D6hVJV8GxWplA4sMrhmra5al1HHGHb3UXmYe6pnY7JNApS4my6uCDqGVdqxfMY5nbhwPYA3Ms-Nwvj\",\r\n  \"notification\": {\r\n    \"body\": \"Suhu Kandang Panas\",\r\n    \"title\": \"Suhu Kandang BeeSet.\"\r\n  }\r\n}",
            CURLOPT_HTTPHEADER => array("Authorization: key=AAAAIOJWNzc:APA91bEhCJVpG-1W2_VvnjYtcpehs6whqIYlLWYtY1A6RDgL5Vmrol9o-zovflnQry9ps7ajqk4RcC_lSC2E6_ffMMnir7MFXCFio2LtA7NKzkGURAcwjRkOGfDLHQ379LTnngJM6dQ3","Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       
        $data = json_decode($response);
        $sukses = $data->success;
        if ($sukses == 1) {
      
        $pesan = "Sukses mengirim Notif";
        }else {
            $pesan = "Gagal Mengirim Notif";
        }

         return response()->json($pesan);
    }

    public function getData(Request $request)
    {
        $panen = ([
            'kandang_id' => $request->field1,
            'berat_panen' => $request->field4,
            ]);

        
        $kandang_id = Panen::create($panen)->kandang_id;

        $aktivitas = new AktivitasKandang();
        $aktivitas->kandang_id = $kandang_id;
        $aktivitas->aktivitas_id = 1;
        $aktivitas->save();

        $latitude = $request->field3;
        $longitude = $request->field2;

        $input = LokasiKandang::where('kandang_id', $kandang_id)->first();

        if($latitude == $input->latitude || $longitude == $input->longitude ) {
            echo "0 0";
        }
        else if(Panen::create($panen)){
            echo "1 0";
        }
        else{
            $input->latitude = $latitude;
            $input->longitude = $longitude;
            $input->save();

            $aktivitas2 = new AktivitasKandang();
            $aktivitas2->kandang_id = $kandang_id;
            $aktivitas2->aktivitas_id = 4;
            $aktivitas2->save();

            echo "1 1";
        }



        return response()->json($panen);
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

        $panen = new Panen();
        $panen->kandang_id = $kandang_id;
        $panen->save();
    
        $lokasi = new LokasiKandang();
        $lokasi->kandang_id = $kandang_id;
        $lokasi->save();
    
        return response()->json(["status"=>"berhasil","kandang"=>$input,"panen"=>$panen],201);
        }
    
        public function updateKandang(Request $request, $id)
        {
            
            $nama= $request->nama;
            $user_id = $request->user_id;
            $kelompok_id = $request->kelompok_id;   
            $new_photo = $request->file('foto');
            if($new_photo){
                if($input->foto && file_exists(storage_path('app/public/uploads' .$input->foto))){
                \Storage::delete('public/uploads'. $input->foto);
            }
            $new_photo_path = $new_photo->storeAs(
                'public/uploads', 'kandang_photobaru'.time().'.'.$request->file('foto')->extension()
            );
            $input->photo = $new_photo_path;
            }   
            $input->save();
            
            return response()->json($input);
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
}
