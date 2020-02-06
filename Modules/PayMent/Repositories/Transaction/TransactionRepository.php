<?php

namespace Modules\PayMent\Repositories\Transaction ;

interface TransactionRepository
{

    public function create(int $userId , int $price , $referenceType , int $referenceId);

    public function all(int $userId);

    public function updateStatus(int $userId);

    public function show(int $transactionId);

}
