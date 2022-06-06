<?php

namespace App\Facades;

class DB extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'db';
    }
}
