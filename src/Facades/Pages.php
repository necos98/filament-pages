<?php

namespace Pages\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pages\Pages
 */
class Pages extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Pages\Pages::class;
    }
}
