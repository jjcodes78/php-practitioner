<?php

namespace App\Core;

use App\Core\Http\Request;
use Closure;

class Router
{
    // coleção (array) de rotas
    protected static $routes = [
        'GET' => [], // rotas registradas com o método get
        'POST' => [], // rotas registrada com o método post
        'DELETE' => [],
        'PUT' => [],
        'PATCH' => [],
    ];

    public static function get($route, $destination)
    {
        self::$routes['GET'][$route] = $destination;
    }

    public static function post($route, $destination)
    {
        self::$routes['POST'][$route] = $destination;
    }

    public static function patch($route, $destination)
    {
        self::$routes['PATCH'][$route] = $destination;
    }

    public static function put($route, $destination)
    {
        self::$routes['PUT'][$route] = $destination;
    }

    public static function delete($route, $destination)
    {
        self::$routes['DELETE'][$route] = $destination;
    }

    //
    public static function resolve()
    {
        $routes = self::$routes;
        if(!in_array(self::getRouteUri(), array_keys($routes[Request::method()]))) {
            return http_response_code(404);
        }

        if(self::getRouteKey() instanceof Closure) {
            return self::getRouteKey()();
        }

        // verificar se a rota aponta para um controller
        if(str_contains(self::getRouteKey(), '@')) {
            $action = explode('@', trim(self::getRouteKey()));
            $controller = $action[0];
            $controllerMethod = $action[1];
            return (new $controller)->{$controllerMethod}();
        }

        return self::getRouteKey();
    }

    protected static function getRouteUri()
    {
        return (Request::queryString()) ?
            str_replace("?" . Request::queryString(), "", Request::uri()) :
            Request::uri();
    }

    protected static function getRouteKey()
    {
        return self::$routes[Request::method()][self::getRouteUri()];
    }
}
