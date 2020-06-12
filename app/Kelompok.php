<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    //
    protected $fillable = ['id','name','address'];

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function kandang()
    {
        return $this->hasMany('App\Kandang');
    }
}
