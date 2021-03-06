<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompok';

    protected $fillable = ['id','nama','alamat','user_id'];

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function kandang()
    {
        return $this->hasMany('App\Kandang');
    }
}
