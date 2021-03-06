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

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nama', 'email', 'password','role_id','kelompok_id','photo','alamat','telpon','status','api_token','api_firebase'
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
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'kelompok_id');
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
        if($this->role_id == 3){
            return true;
        }
        return false;    
        
    }

    public function isPj(){
        if($this->role_id == 2){
            return true;
        }
        return false;
    }

    public function isSuper(){
        if($this->role_id == 1){
            return true;
        }
        return false;
    }
}
