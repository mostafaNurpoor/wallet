<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Responses\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Wallet\Repositories\Wallet\walletRepository;

class WalletController extends Controller
{
    private $walletRepository;

    public function __construct(walletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function chargeWallet(Request $request)
    {

        $chargeWallet = $this->walletRepository->chargeWallet(Auth::id(), $request->amount);

        return GeneralResponse::success($chargeWallet);

    }

    public function spend(Request $request)
    {

        $spend = $this->walletRepository->spend(Auth::id(), $request->amount);

        return GeneralResponse::success($spend);

    }

}
