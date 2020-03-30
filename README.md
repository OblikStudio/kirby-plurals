# kirby-plurals

Allows you to use language variables to translate a string according to that language's plural forms defined in [the Unicode CLDR](http://www.unicode.org/cldr/charts/27/supplemental/language_plural_rules.html). For more information, check [php-pluralization](https://github.com/OblikStudio/php-pluralization) which is a dependency of this plugin.

## Installation

With [Composer](https://packagist.org/packages/oblik/kirby-plurals):

```
composer require oblik/kirby-plurals
```

## Usage

You get a `tp()` (translate plural) helper function that works similar to other [helper functions](https://getkirby.com/docs/reference/templates/helpers) and especially, [`tc()`](https://getkirby.com/docs/reference/templates/helpers/tc).

Here's an example language file _en.php_:

```php
return [
    'code' => 'en',
    'default' => true,
    'name' => 'English',
    'translations' => [
        'apples' => [
            'one' => '{{ count }} apple',
            'other' => '{{ count }} apples'
        ],
        'place' => [
            'one' => '{{ position }}st',
            'two' => '{{ position }}nd',
            'few' => '{{ position }}rd',
            'other' => '{{ position }}th'
        ],
        'cookies' => [
            'other' => '{{ start }}-{{ end }} cookies'
        ]
    ]
];
```

You can translate:

- cardinals, by using a `count` key
- ordinals, by using a `position` key
- ranges, by using a `start` and an `end` key

```php
tp('apples', [ 'count' => 1 ]);                 // 1 apple
tp('apples', [ 'count' => 3 ]);                 // 3 apples
tp('place', [ 'position' => 1 ]);               // 1st
tp('place', [ 'position' => 103 ]);             // 103rd
tp('cookies', [ 'start' => 3, 'end' => 4 ]);    // 3-4 cookies
```

### Locale Mapping

If you're using different locale names, you can map them with the `oblik.plurals.map` config option. For example, if you have two languages `en-us` and `en-gb`, you need to map them both to the `en` pluralizator class since both of them have the same pluralization rules:

`site/config/config.php`

```php
return [
    'oblik.plurals.map' => [
        'en-us' => 'en',
        'en-gb' => 'en'
    ]
];
```

Check the available pluralization classes [here](https://github.com/OblikStudio/php-pluralization/blob/master/index.php).
