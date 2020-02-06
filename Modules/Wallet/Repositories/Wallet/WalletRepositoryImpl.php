<?php

namespace Modules\Wallet\Repositories\Wallet ;

use App\User;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Exceptions\WalletException;

class WalletRepositoryImpl implements walletRepository {

    public function chargeWallet($userId, $amount)
    {
        $user = User::find($userId);

        if (!$user){

            throw new WalletException(__(Error::DB_Item_Not_Found));
        }

   //   $wallet = Wallet::where(Wallet::userId , $userId)->get();

//        if ($wallet->exists()){
//
//        }
//        $status = $item->save();

     //   return $wallet->exists() ;

    }

    public function spend($userId, $amount)
    {

    }

}
