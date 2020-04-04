<?php

use Kirby\Toolkit\Str;
use Kirby\Toolkit\I18n;
use const Oblik\Pluralization\LANGUAGES;

function tp($key, array $data, $locale = null)
{
    $lc = $locale ?? I18n::locale();
    $map = option('oblik.plurals.map');

    if (is_array($map) && !empty($map[$lc])) {
        $lc = $map[$lc];
    }

    $pluralizer = LANGUAGES[$lc] ?? null;

    if ($pluralizer) {
        if (isset($data['count'])) {
            $form = $pluralizer::getCardinal($data['count']);
        } else if (isset($data['position'])) {
            $form = $pluralizer::getOrdinal($data['position']);
        } else if (isset($data['start']) && isset($data['end'])) {
            $form = $pluralizer::getRange($data['start'], $data['end']);
        }

        if (isset($form)) {
            $form = $pluralizer::formName($form);
            $translations = I18n::translation($locale)[$key] ?? null;

            if (is_array($translations)) {
                $translation = $translations[$form] ?? null;
            }

            if (empty($translation)) {
                $translation = I18n::translation($locale)[$key . ".$form"] ?? null;
            }

            if (is_string($translation)) {
                return Str::template($translation, $data);
            }
        }
    }

    $fallback = I18n::fallback();

    if ($fallback !== $locale) {
        return tp($key, $data, $fallback);
    } else {
        return null;
    }
}

function tpc($key, $count, $locale = null)
{
    return tp($key, ['count' => $count], $locale);
}

function tpo($key, $position, $locale = null)
{
    return tp($key, ['position' => $position], $locale);
}

function tpr($key, $start, $end, $locale = null)
{
    return tp($key, ['start' => $start, 'end' => $end], $locale);
}
