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

            $berat = Panen::select('kandang.nama as kandang', 'panen.berat_panen','panen.created_at')
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->where('kandang.user_id', $id_user)
            ->get();

            $akumulasi = Panen::select('kandang.nama as kandang',DB::raw('SUM(berat_panen) as total'))
            ->join('kandang','kandang.id','=','panen.kandang_id')
            ->join('users','users.id','=','kandang.user_id')
            ->where('kandang.user_id', $id_user)
            ->get();

           
        return view('telegram', compact('pesan','kandang','berat','id','akumulasi'));
   
       
    }

}
