<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDescription extends Model
{
    //
    protected $table ='ms_users_description';
    
    public function user(){
        return $this->hasOne('App\User', 'id', 'users_id');
    }
}
