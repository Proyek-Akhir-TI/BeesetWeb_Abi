<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JenisAktivitas;
use App\User;

class AktivitasPeternak extends Model
{
	protected $fillable = [
        'id','user_id','aktivitas_id'
    ];
    //
    // public function aktivitas(){
    //     return $this->belongsTo('App\JenisAktivitas','aktivitas_id');
    // }

    // public function user(){
    // 	return $this->belongsTo('App\User', 'user_id');
    // }
}
