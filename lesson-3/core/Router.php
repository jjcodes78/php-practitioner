<?php

class Router
{
    // coleção (array) de rotas
    protected static $routes = [
        'GET' => [], // rotas registradas com o método get
        'POST' => [] // rotas registrada com o método post
    ];

    public static function get($route, $destination)
    {
        self::$routes['GET'][$route] = $destination;
    }

    public static function post($route, $destination)
    {
        self::$routes['POST'][$route] = $destination;
    }

    //
    public static function resolve(string $uri, string $method = 'GET')
    {
        $cleanUri = (isset($_SERVER['QUERY_STRING'])) ?
            str_replace("?" . $_SERVER['QUERY_STRING'], "", $uri) :
            $uri;

        $routes = self::$routes;
        if(!in_array($cleanUri, array_keys($routes[$method]))) {
            return http_response_code(404);
        }

        if($routes[$method][$cleanUri] instanceof Closure) {
            return $routes[$method][$cleanUri]();
        }

        return $routes[$method][$cleanUri];
    }
}
