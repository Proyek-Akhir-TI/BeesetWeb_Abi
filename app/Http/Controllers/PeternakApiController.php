<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kandang;
use App\Panen;

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
    	$kelompoks = Kelompok::pluck('name','id');

    	return response()->json($kelompoks);
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

    public function getBeratPanen(Request $request)
    {
        $panen = new Panen([
            'kandang_id' => $request->get('kandang_id'),
            'berat_panen' => $request->get('berat_panen')
            ]);
        $panen->save();

        return response()->json($panen);
    }

    public function getLokasiKandang(Request $request)
    {
        $panen = new Panen([
            'kandang_id' => $request->get('kandang_id'),
            'berat_panen' => $request->get('berat_panen')
            ]);
        $panen->save();

        return response()->json($panen);
    }
}
