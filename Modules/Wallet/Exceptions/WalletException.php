<?php

namespace Modules\Wallet\Exceptions;


use App\Http\Responses\GeneralResponse;

class WalletException extends \Exception
{

    public function report()
    {

    }

    public function render($request)
    {

        return response(GeneralResponse::failed($this->getMessage()), 422);

    }
}
