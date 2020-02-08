<?php

namespace Modules\PayMent\Repositories\Transaction;

use App\User;
use Error;
use Illuminate\Pagination\Paginator;
use Modules\PayMent\Entities\Transaction;
use Modules\PayMent\Entities\TransactionStatus;
use Modules\PayMent\Exceptions\PaymentException;
use Shetabit\Payment\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Invoice;
use Modules\Wallet\Repositories\Wallet\WalletRepository ;


class TransactionRepositoryImpl implements TransactionRepository
{

    private $walletRepository ;

    public function __construct(WalletRepository $walletRepository)
    {

        $this->walletRepository = $walletRepository ;

    }

    public function create($userId, $price, $referenceType, $referenceId)
    {
        $price = (int)$price;

        $invoice = (new Invoice())->amount($price);

        $transaction = [
            Transaction::userId => $userId,
            Transaction::price => $price,
            Transaction::status => TransactionStatus::WAITING_FOR_BANK_RESPONSE,
            Transaction::transactionTrackingId => TransactionStatus::WAITING_FOR_BANK_RESPONSE,
            Transaction::referenceType => $referenceType,
            Transaction::referenceId => $referenceId,
        ];

        $newTransaction = Transaction::create($transaction);

        $transactionId = $newTransaction->{Transaction::transactionId};

        Payment::callbackUrl(Transaction::callBackUrl . '/' . $transactionId)->via(Transaction::driver)->purchase($invoice);

        return $invoice->getTransactionId();

    }

    /**
     * @param int $userId
     * @param int $page
     * @return mixed
     * @throws PaymentException
     */
    public function all($userId, $page)
    {
        $userExists = User::find($userId);

        if (!$userExists) {

            throw new PaymentException(__(Error::DB_Item_Not_Found));

        }

        $userTransactions = Transaction::where(Transaction::userId, $userId)->orderBy(Transaction::transactionId, 'DESC');

        Paginator::currentPageResolver(function () use ($page) {

            return $page;

        });

        $transactionPage = $userTransactions->paginate(15);

        if (count($transactionPage) == 0) {

            //throw new PaymentException(__(Error::DB_Item_Not_Found)) ;

            throw new PaymentException("does not have row");

        }

        return $transactionPage;

    }

    public function updateStatus($userId)
    {

    }

    public function show($transactionId)
    {

    }

    public function verify($paymentId)
    {
        $payment = Transaction::find($paymentId);

        if (!$payment) {

            throw new PaymentException("does not have row");

        }

        try {

            $price = $payment->{Transaction::price} ;

            $userId = $payment->{Transaction::userId} ;

            $receipt = Payment::amount($price)->verify();

            $transactionTrackingId = $receipt->getReferenceId();

            $payment->{Transaction::transactionTrackingId} = $transactionTrackingId ;

            if ($payment->save()) {

                $wallet = $this->walletRepository->chargeWallet($userId , $price);

                if (!$wallet || $wallet != 1){

                    throw new PaymentException("query fail");

                } else if ($wallet){

                    $message = 'set successfully';

                } else if ($wallet == 1){

                    $message = 'update successfully';

                }

            }


        } catch (InvalidPaymentException $exception) {

            $message = $exception->getMessage();
        }

        return $wallet;
    }

}
