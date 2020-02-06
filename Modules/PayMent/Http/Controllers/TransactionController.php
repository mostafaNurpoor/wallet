<?php

namespace Modules\PayMent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\PayMent\Repositories\Transaction\TransactionRepository;
use App\Http\Responses\GeneralResponse ;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Invoice;

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

        //return GeneralResponse::success($transaction);

        return $transaction ;

    }

    public function verify(Request $request){

    }

//    public function executeStrategy(array $elements): array
//    {
//        uasort($elements, [$this->comparator, 'authority']);
//
//        return $elements;
//    }

}
