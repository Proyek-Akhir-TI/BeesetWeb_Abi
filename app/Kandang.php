<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Kelompok;

class Kandang extends Model
{
    protected $table = 'kandang';

    protected $fillable = [
        'id',
        'nama', 
        'user_id', 
        'kelompok_id',
        'url',
        'status',
        'foto'
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
