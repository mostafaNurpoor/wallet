<?php
/**
 * Created by PhpStorm.
 * User: ASUS  FX553VD
 * Date: 2/8/2020
 * Time: 17:32
 */

namespace Modules\PayMent\Entities;


class TransactionStatus
{

    const WAITING_FOR_BANK_RESPONSE = 0;
    const PURCHASED = 1;
    const FAILED = -1;

}
