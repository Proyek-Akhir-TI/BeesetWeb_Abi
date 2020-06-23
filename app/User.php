<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
use App\Kelompok;
use App\Kandang;
use App\AktivitasPeternak;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','role_id','kelompok_id','photo','address','telp','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function kelompok(){
        return $this->belongsTo('App\Kelompok');
    }

    public function kandang()
    {
        return $this->hasMany('App\Kandang');
    }

    public function user()
    {
        return $this->belongsToMany('App\AktivitasPeternak', 'aktivitas_peternaks');
    }

    public function isKetua(){
        if($this->role->name == 'Ketua Kelompok'){
            return true;
        }
        return false;    
        
    }

    public function isPj(){
        if($this->role->name == 'Penanggung Jawab'){
            return true;
        }
        return false;
    }

    public function isSu(){
        if($this->role->name == 'Super User'){
            return true;
        }
        return false;
    }
}
