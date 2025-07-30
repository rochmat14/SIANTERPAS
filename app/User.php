<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status','images','verified_status','email_verified_at','activation_code','last_login'
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


    public function userDescription(){
        return $this->hasOne('App\UserDescription','users_id', 'id');
    }

    public function ship(){
        return $this->hasOne(ShipsUsers::class,'id_user', 'id');
    }

    public function activateAccount($code)
    {
 
        $user = User::where('activation_code', $code)->first();
        if($user){
            $user->update(['verified_status' => 1, 'activation_code' => NULL,'email_verified_at'=>date('d-m-Y h:i:s')]);
            \Auth::login($user);
            return true;
        }
    }

    
}
