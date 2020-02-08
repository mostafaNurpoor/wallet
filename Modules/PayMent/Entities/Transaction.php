<?php

namespace Modules\PayMent\Entities;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    const transactionId = 'id' ;

    const userId = 'user_id' ;

    const price = 'price' ;

    const transactionTrackingId = 'transaction_tracking_id' ;

    const status = 'status' ;

    const referenceType = 'reference_type' ;

    const referenceId = 'reference_id' ;

    const createdAt = 'created_at' ;

    const updatedAt = 'updated_at' ;

    // bank api configuration

    const merchantID = 'e6f68636-04b6-11ea-9e2c-000c295eb8fc' ;

    const callBackUrl = 'http://f9138f9d.ngrok.io/laravel/wallet/public/api/transaction/verify' ;

    const driver = 'zarinpal';

    //authority

    protected $fillable = [
        'user_id', 'price' , 'transaction_tracking_id' , 'status' , 'reference_type' , 'reference_id'
    ];

}
