<?php

namespace Oblik\Pluralization\Rules;

use const Oblik\Pluralization\ONE;
use const Oblik\Pluralization\OTHER;

trait Cardinal2 {
    static function cardinal($n)
    {
        if ($n == 1) {
            return ONE;
        } else {
            return OTHER;
        }
    }
}
