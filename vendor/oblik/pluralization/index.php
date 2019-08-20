<?php

namespace Oblik\Pluralization;

const ZERO = 0;
const ONE = 1;
const TWO = 2;
const FEW = 3;
const MANY = 4;
const OTHER = 5;

const LANGUAGES = [
  'bg' => BulgarianLanguage::class,
  'de' => GermanLanguage::class,
  'es' => SpanishLanguage::class,
  'en' => EnglishLanguage::class,
  'ru' => RussianLanguage::class
];
