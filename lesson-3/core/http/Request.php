<?php
namespace App\Core\Http;

class Request
{
    public static function uri()
    {
        return $_SERVER['REQUEST_URI'] ?? null;
    }

    public static function method()
    {
        if(isset($_POST['_method'])) {
            return strtoupper($_POST['_method']);
        }

        return $_SERVER['REQUEST_METHOD'] ?? null;
    }

    public static function queryString($key = null)
    {
        if (! is_null($key)) {
            if (! isset($_SERVER['QUERY_STRING'])) return null;

            $queries = explode("&", $_SERVER['QUERY_STRING']);
            foreach ($queries as $query) {
                $resultQuery = explode("=", $query);
                if($resultQuery[0] == $key) {
                    return $resultQuery[1];
                }
            }
            return null;
        }
        return $_SERVER['QUERY_STRING'] ?? null;
    }

    public static function getPostValue(string $key)
    {
        return $_POST[$key];
    }
}
