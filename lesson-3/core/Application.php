<?php

class Application
{
    public static function start()
    {
        require __DIR__ . "/../routes.php";
        Router::resolve(Request::uri(), Request::method());
    }
}
