<?php

namespace Modules\Wallet\Entities;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    const transactionId = 'id' ;

    const userId = 'user_id' ;

    const price = 'price' ;

    const authority = 'authority' ;

    const status = 'status' ;

    const createdAt = 'created_at' ;

    const updatedAt = 'updated_at' ;

    protected $fillable = [
        'user_id', 'price', 'authority'
    ];
}
