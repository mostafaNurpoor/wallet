<?php

namespace Modules\PayMent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\PayMent\Repositories\Transaction\TransactionRepository;
use App\Http\Responses\GeneralResponse ;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {

        $this->transactionRepository = $transactionRepository ;

    }

    public function create(Request $request)
    {

        $transaction = $this->transactionRepository->create(Auth::id() , $request->price , $request->referenceType , $request->referenceId);

        return $transaction ;

    }

    public function userTransactions($page)
    {

        $userTransaction = $this->transactionRepository->all(Auth::id() , $page);

        return GeneralResponse::success($userTransaction);

    }

    public function verify($paymentId)
    {

        $userTransaction = $this->transactionRepository->verify($paymentId);

        return GeneralResponse::success($userTransaction);

    }

}
