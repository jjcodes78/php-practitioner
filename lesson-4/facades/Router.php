<?php

namespace App\Facades;

/**
 * @method static get($route, $destination)
 * @method static post($route, $destination)
 * @method static patch($route, $destination)
 * @method static put($route, $destination)
 * @method static delete($route, $destination)
 * @method static resolve()
 *
 * @see \App\Core\Router;
 */
class Router extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'router';
    }
}
