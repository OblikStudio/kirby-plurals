<?php

namespace Oblik\Pluralization;

abstract class Language
{
    /**
     * n	absolute value of the source number (integer and decimals).
     * i	integer digits of n.
     * v	number of visible fraction digits in n, with trailing zeros.
     * w	number of visible fraction digits in n, without trailing zeros.
     * f	visible fractional digits in n, with trailing zeros.
     * t	visible fractional digits in n, without trailing zeros.
     * @see http://unicode.org/reports/tr35/tr35-numbers.html#Operands
     */
    private static function parseNumber($number) {
        if (!is_string($number)) {
            $number = (string) $number;
        }

        $split = explode('.', $number);
        $integer = array_shift($split);
        $fraction = implode('', $split);

        return [
            (float) $number,
            (int) $integer,
            strlen($fraction)
        ];
    }

    protected static function inRange(int $n, array $range) {
        return $n >= $range[0] && $n <= $range[1];
    }

    public static function getCardinal($number)
    {
        return call_user_func_array(
            static::class . '::cardinal',
            self::parseNumber($number)
        );
    }

    public static function getOrdinal($number)
    {
        return static::ordinal((int) $number);
    }

    public static function getRange($start, $end)
    {
        $startType = static::getCardinal($start);
        $endType = static::getCardinal($end);
        $rangeType = $startType . $endType;

        if (isset(static::RANGE[$rangeType])) {
            return static::RANGE[$rangeType];
        } else {
            return null;
        }
    }

    public static function formName($form) {
        switch ($form) {
            case ZERO: return 'zero';
            case ONE: return 'one';
            case TWO: return 'two';
            case FEW: return 'few';
            case MANY: return 'many';
            case OTHER: return 'other';
        }

        return null;
    }
}
