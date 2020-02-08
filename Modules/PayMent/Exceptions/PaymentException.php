<?php

namespace Modules\PayMent\Exceptions;


use App\Http\Responses\GeneralResponse;

class PaymentException extends \Exception
{

    public function report()
    {

    }

    public function render($request)
    {

        return response(GeneralResponse::failed($this->getMessage()), 422);

    }
}
