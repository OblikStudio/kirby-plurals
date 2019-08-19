<?php

use function Oblik\Plurals\translatePlural;

function tp($key, array $data)
{
    return translatePlural($key, $data, null);
}
