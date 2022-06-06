<?php
namespace App\Facades;

/**
 * @method static queryString(string $key = null)
 * @method static method()
 * @method static uri()
 * @method static getPostValue(string $key)
 *
 * @see \App\Core\Router;
 */
class Request extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'request';
    }
}
