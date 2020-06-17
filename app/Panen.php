<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    //
    public function kandang()
    {
    	return $this->belongsTo('App\Kandang');
    }
}
