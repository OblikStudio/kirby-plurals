<?php

namespace Oblik\Pluralization\Rules;

use const Oblik\Pluralization\ONE;
use const Oblik\Pluralization\OTHER;

trait Cardinal1 {
    static function cardinal($n, $i, $v)
    {
        if ($i === 1 && $v === 0) {
            return ONE;
        } else {
            return OTHER;
        }
    }
}
