<?php

namespace Modules\PayMent\Repositories\Comparator;

class TextComparator implements Comparator
{
    public function compare($a, $b): int
    {

        return $a['id'] <=> $b['id'];

    }
}
