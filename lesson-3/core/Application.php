<?php

namespace App\Core;

class Application
{
    public static function start()
    {
        require __DIR__ . "/../routes.php";
        Router::resolve();
    }
}
