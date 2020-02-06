<?php

namespace Modules\PayMent\Entities;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    const transactionId = 'id' ;

    const userId = 'user_id' ;

    const price = 'price' ;

    const authority = 'authority' ;

    const status = 'status' ;

    const referenceType = 'reference_type' ;

    const referenceId = 'reference_id' ;

    const createdAt = 'created_at' ;

    const updatedAt = 'updated_at' ;


    // bank api configuration

    const merchantID = 'e6f68636-04b6-11ea-9e2c-000c295eb8fc' ;

    const callBackUrl = 'http://www.signaltime.ir/dashboard/pay/verify.php' ;

    // zarinpal url

    const zarinPalUrl = 'https://www.zarinpal.com/pg/services/WebGate/wsdl';

    protected $fillable = [
        'user_id', 'price', 'authority' , 'status' , 'reference_type' , 'reference_id'
    ];
}
