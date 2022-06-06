<?php

namespace App\Facades;

/**
 * @method static to($route, $status = 302)
 *
 * @see \App\Core\Router;
 */
class Redirect extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'redirect';
    }
}
