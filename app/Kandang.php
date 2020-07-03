<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Kelompok;

class Kandang extends Model
{
    //
    protected $fillable = [
        'name', 
        'user_id', 
        'kelompok_id',
        'tkUrl',
        'location',
        'latitude',
        'longitude',
        'status',
    ];

    public function kelompok(){
        return $this->belongsTo('App\Kelompok','kelompok_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function panen()
    {
        return $this->hasMany('App\Panen');
    }
}
