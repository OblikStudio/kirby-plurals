<?php

namespace Oblik\Pluralization;

class GermanLanguage extends Language
{
    use Rules\Cardinal1;

    static function ordinal($n)
    {
        return OTHER;
    }

    const RANGE = [
        ONE . OTHER => OTHER,
        OTHER . ONE => ONE,
        OTHER . OTHER => OTHER
    ];
}
