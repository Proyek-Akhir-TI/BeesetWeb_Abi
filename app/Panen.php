<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $table = 'panen';
    protected $fillable = ['kandang_id','berat_panen'];
    //
    public function kandang()
    {
    	return $this->belongsTo('App\Kandang');
    }
}
