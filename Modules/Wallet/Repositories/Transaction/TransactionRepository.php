<?php

namespace Modules\Wallet\Repositories\Transaction ;

interface TransactionRepository
{

    public function create($userId ,$price);

    public function all($userId);

    public function updateStatus($userId);

    public function show($transactionId);

}
