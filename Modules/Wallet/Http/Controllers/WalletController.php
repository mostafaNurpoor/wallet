<?php

namespace Modules\Wallet\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Wallet\Repositories\Wallet\walletRepository ;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Responses\GeneralResponse ;

class WalletController extends Controller
{
    private $walletRepository ;

    public function __construct(walletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function chargeWallet(Request $request)
    {

        $chargeWallet = $this->walletRepository->chargeWallet(Auth::id() , $request->amount);

        return GeneralResponse::success($chargeWallet);

    }

    public function spend(Request $request)
    {

        $spend = $this->walletRepository->spend(Auth::id() , $request->amount);

        return GeneralResponse::success($spend);

    }

}
