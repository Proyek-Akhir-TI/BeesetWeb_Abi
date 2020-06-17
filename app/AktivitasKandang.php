<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktivitasKandang extends Model
{
    //
    public function aktivitasKandang(){
        return $this->belongsTo('App\JenisAktivitas','aktivitas_id');
    }

}
