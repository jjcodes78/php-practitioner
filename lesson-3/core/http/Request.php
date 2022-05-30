<?php

class Request
{
    public static function uri()
    {
        return $_SERVER['REQUEST_URI'] ?? null;
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'] ?? null;
    }

    public static function queryString()
    {
        return $_SERVER['QUERY_STRING'] ?? null;
    }
}
