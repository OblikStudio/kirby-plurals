<?php

namespace Oblik\Pluralization;

class EnglishLanguage extends Language
{
    use Rules\Cardinal1;

    static function ordinal($n)
    {
        $mod10 = $n % 10;
        $mod100 = $n % 100;

        if ($mod10 === 1 && $mod100 != 11) {
            return ONE;
        } elseif ($mod10 === 2 && $mod100 != 12) {
            return TWO;
        } else if ($mod10 === 3 && $mod100 != 13) {
            return FEW;
        }

        return OTHER;
    }

    const RANGE = [
        ONE . OTHER => OTHER,
        OTHER . ONE => OTHER,
        OTHER . OTHER => OTHER
    ];
}
