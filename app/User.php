<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    const userId = 'id' ;

    const name = 'name' ;

    const familyName = 'family_name' ;

    const phone_number = 'phone_number' ;

    const email = 'email' ;

    const OTP = 'OTP' ;

    const createdAt = 'created_at' ;

    const updatedAt = 'updated_at' ;

    // token passport
    const secretToken = '6nYwgIJVPCx6VgS0wDOB528SztQ62JikwJB16qBI';

    const clientId = '2';

    use HasApiTokens ,  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'family_name' ,  'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ ];

}
