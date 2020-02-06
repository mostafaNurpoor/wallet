<?php

namespace Modules\PayMent\Repositories\Transaction ;

use Modules\PayMent\Entities\Transaction ;
use Shetabit\Payment\Exceptions\PurchaseFailedException;
use Shetabit\Payment\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Drivers\Zarinpal\Zarinpal ;


class TransactionRepositoryImpl implements TransactionRepository {

    public function create($userId, $price , $referenceType , $referenceId)
    {
        $price = (int) $price ;

        $invoice = (new Invoice())->amount($price) ;

         return Payment::callbackUrl(Transaction::callBackUrl)->purchase($invoice,
            function($driver, $transactionId) use ($userId , $price ,$referenceType , $referenceId) {

                $transaction = new Transaction() ;

                $transaction->{Transaction::userId} = $userId ;

                $transaction->{Transaction::price} = $price ;

                $transaction->{Transaction::authority} = $transactionId ;

                $transaction{Transaction::status} = 0 ;

                $transaction{Transaction::referenceType} = $referenceType ;

                $transaction{Transaction::referenceId} = $referenceId ;

                $transaction->save() ;

            }
        )->pay();

    }

    public function all($userId)
    {

    }

    public function updateStatus($userId)
    {

    }

    public function show($transactionId)
    {

    }

}
