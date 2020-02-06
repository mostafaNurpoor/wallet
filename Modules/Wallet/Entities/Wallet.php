<?php

namespace Modules\Wallet\Entities;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    const walletId = 'id' ;

    const userId = 'user_id' ;

    const remain = 'remain' ;

    const status = 'status' ;

    const deletedAt = 'deleted_at' ;

    const createdAt = 'created_at' ;

    const updatedAt = 'updated_at' ;

    protected $fillable = [
        'user_id' , 'remain' , 'status'
    ];
}
