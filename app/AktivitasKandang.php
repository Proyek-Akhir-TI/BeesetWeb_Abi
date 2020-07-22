<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktivitasKandang extends Model
{
    protected $table = 'aktivitas_kandang';
    //
    // public function aktivitasKandang(){
    //     return $this->belongsTo('App\JenisAktivitas','aktivitas_id');
    // }

    protected $fillable = ['kandang_id','aktivitas_id'];

}
