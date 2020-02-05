<?php

namespace Modules\Wallet\Repositories\Wallet ;

use App\User;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Exceptions\WalletException;
use Modules\Wallet\Repositories\Transaction\TransactionRepository ;

class WalletRepositoryImpl implements walletRepository {

    public $transactionRepository ;

    public function __construct(TransactionRepository $transactionRepository)
    {

        $this->transactionRepository = $transactionRepository ;

    }

    public function chargeWallet($userId, $amount)
    {
        $user = User::find($userId);

        if (!$user){

            throw new WalletException(__(Error::DB_Item_Not_Found));
        }

        $wallet = Wallet::where(Wallet::userId , $userId)->first();

        if (!$wallet){

            throw new WalletException(__(Error::DB_Item_Not_Found));

        }

        $wallet->increment($wallet->{Wallet::remain} , $amount);

        return $wallet ;

    }

    public function spend($userId, $amount)
    {

    }

}
