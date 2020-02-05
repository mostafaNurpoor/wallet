<?php

namespace Modules\Wallet\Repositories\Wallet ;

interface WalletRepository
{

    public function chargeWallet($userId , $amount);

    public function spend($userId , $amount);

}
