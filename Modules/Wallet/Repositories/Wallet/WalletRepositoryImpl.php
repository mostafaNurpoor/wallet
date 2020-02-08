<?php

namespace Modules\Wallet\Repositories\Wallet ;

use App\User;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\WalletStatus ;
use Modules\Wallet\Exceptions\WalletException;

class WalletRepositoryImpl implements walletRepository {

    public function chargeWallet($userId, $amount)
    {
        $user = User::find($userId);

        if (!$user)
        {

            throw new WalletException(__(Error::DB_Item_Not_Found));

        }

        $wallet = Wallet::where(Wallet::userId , $userId);

        if (!$wallet->exists()){

            $userWallet = new Wallet();

            $userWallet->{Wallet::userId} = $userId ;

            $userWallet->{Wallet::status} = WalletStatus::WALLET_IS_ACTIVE ;

            $userWallet->{Wallet::remain} = $amount ;

            $userWallet->save();

        } else {

            $wallet->increment(Wallet::remain , $amount);

        }

        return $wallet ;

    }

    public function spend($userId, $amount)
    {

    }

}
