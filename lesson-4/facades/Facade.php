<?php

namespace App\Facades;

use Exception;

abstract class Facade implements FacadeContract
{
    public static function getFacadeParameters(): array
    {
        return [];
    }

    /**
     * @throws Exception
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $concreteInstance = app()->resolve(static::getFacadeAccessor(), static::getFacadeParameters());
        return ($concreteInstance)->$name(...$arguments);
    }
}
