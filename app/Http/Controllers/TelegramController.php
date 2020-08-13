<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\LokasiKandang;
use App\Panen;
use DB;
use Telegram;

class TelegramController extends Controller
{
    public static function tele(){
        $id = Telegram::getID();
        $pesan = strtolower(Telegram::telegram());
        $nama = Telegram::getNama();

        $user = User::where('nama', $nama)->first();

        $id_user = $user['id'];
        $kandang = LokasiKandang::select('kandang.nama','lokasi_kandang.latitude','lokasi_kandang.longitude')
            ->join('kandang','kandang.id','=','lokasi_kandang.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->where('kandang.user_id', $id_user)
            ->get();

        $berat = Panen::select('kandang.nama as kandang', DB::raw('SUM(berat_panen) as total'))
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->where('kandang.user_id', $id_user)
            ->get();

           
    if ($pesan == "lokasi") {
        foreach($kandang as $val){
            $balas =  $val->nama." "."https://www.google.com/maps/@".$val->latitude.",".$val->longitude."".",10.0z"; 
            echo $balas;
            $status = Telegram::sendMessage($id,$balas);
            }
        }
    else if($pesan == "berat"){
        foreach($berat as $val){
            $balas = $val->kandang." Telah panen sebanyak ".(float)$val->total." Kg";
            echo $pesan;
            $status = Telegram::sendMessage($id,$balas);
            }
    }
        
            else{
                echo $pesan;
            }
        
        
       
    }

}
