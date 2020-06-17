<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AktivitasPeternak;

class JenisAktivitas extends Model
{
    //

    public function aktivitas()
    {
        return $this->belogsToMany('App\AktivitasPeternak','aktivitas_peternaks');
    }
}
