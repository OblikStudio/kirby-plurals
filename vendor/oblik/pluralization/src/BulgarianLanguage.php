<?php

namespace Oblik\Pluralization;

class BulgarianLanguage extends Language
{
    use Rules\Cardinal2;

    static function ordinal($n)
    {
        return OTHER;
    }

    const RANGE = [
        ONE . OTHER => OTHER,
        OTHER . ONE => OTHER,
        OTHER . OTHER => OTHER
    ];
}
