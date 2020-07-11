<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AktivitasPeternak;

class JenisAktivitas extends Model
{
    protected $table = 'jenis_aktivitas';

    // public function aktivitas()
    // {
    //     return $this->belogsToMany('App\AktivitasPeternak','aktivitas_peternaks');
    // }
}
