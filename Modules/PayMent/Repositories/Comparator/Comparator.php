<?php

namespace Modules\PayMent\Repositories\Comparator;

interface Comparator
{

    public function compare($a, $b): int;

}
