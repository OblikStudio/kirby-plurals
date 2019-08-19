<?php

namespace Oblik\Pluralization;

abstract class Language
{
    abstract protected static function cardinal(int $i, $v): int;
    abstract protected static function ordinal(int $n): int;

    private static function parseNumber($number) {
        if (!is_string($number)) {
            $number = (string) $number;
        }

        $split = explode('.', $number);
        $integer = (int) $split[0];
        $fraction = isset($split[1]) ? (float) ('0.' . $split[1]) : null;

        return [
            'integer' => $integer,
            'fraction' => $fraction
        ];
    }

    protected static function inRange(int $n, array $range) {
        return $n >= $range[0] && $n <= $range[1];
    }

    public static function getCardinal($number)
    {
        // In some languages (like Russian), there's a difference between `0`
        // and `0.0`. Since those values are the same in PHP, they should be
        // represented as strings so that decimal points aren't lost.
        $number = self::parseNumber($number);

        return static::cardinal(
            $number['integer'],
            $number['fraction']
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
