<?php

namespace Oblik\Plurals;

use Kirby\Toolkit\Str;
use Kirby\Toolkit\I18n;
use const Oblik\Pluralization\LANGUAGES;

@include_once __DIR__ . '/vendor/autoload.php';

function translatePlural($key, array $data, $locale = null)
{
    if (!$locale) {
        $locale = I18n::locale();
    }

    $pluralizer = LANGUAGES[$locale] ?? LANGUAGES[Locale::getPrimaryLanguage($locale)] ?? null;
    
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
            $translations = I18n::translate($key, null, $locale);

            if (is_array($translations)) {
                $translation = $translations[$form] ?? null;
            }
            
            if (empty($translation)) {
                $translation = I18n::translate($key . ".$form", null, $locale);
            }

            if (is_string($translation)) {
                return Str::template($translation, $data);
            }
        }
    }

    $fallback = I18n::fallback();

    if ($locale !== $fallback) {
        return translatePlural($key, $data, $fallback);
    } else {
        return null;
    }
}

require_once 'global.php';
