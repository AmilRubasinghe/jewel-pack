<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $primaryKey = 'ID';
    
    protected $fillable=[
        'firstName','lastName','email','password',
    ];

    protected $hidden=[
        'password','remember_password',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }
    
}
