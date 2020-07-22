<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiKandang extends Model
{
    protected $table = 'lokasi_kandang';

    protected $fillable = [
        'kandang_id','latitude','longitude'
    ];
}
