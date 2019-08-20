<?php

namespace Oblik\Pluralization;

class RussianLanguage extends Language
{
    static function cardinal($n, $i, $v)
    {
        $mod10 = $i % 10;
        $mod100 = $i % 100;

        if ($v === 0) {
            if ($mod10 == 1 && $mod100 != 11) {
                return ONE;
            } elseif (
                self::inRange($mod10, [2, 4]) &&
                !self::inRange($mod100, [12, 14])
            ) {
                return FEW;
            } elseif (
                $mod10 == 0 ||
                self::inRange($mod10, [5, 9]) ||
                self::inRange($mod100, [11, 14])
            ) {
                return MANY;
            }
        }

        return OTHER;
    }

    static function ordinal()
    {
        return OTHER;
    }

    const RANGE = [
        ONE . ONE => ONE,
        ONE . FEW => FEW,
        ONE . MANY => MANY,
        ONE . OTHER => OTHER,
        FEW . ONE => ONE,
        FEW . FEW => FEW,
        FEW . MANY => MANY,
        FEW . OTHER => OTHER,
        MANY . ONE => ONE,
        MANY . FEW => FEW,
        MANY . MANY => MANY,
        MANY . OTHER => OTHER,
        OTHER . ONE => ONE,
        OTHER . FEW => FEW,
        OTHER . MANY => MANY,
        OTHER . OTHER => OTHER
    ];
}
