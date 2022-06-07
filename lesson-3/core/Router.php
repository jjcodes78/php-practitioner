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

    public static function resolve()
    {
        // Simplificamos as rotas registradas em self:$routes para a variável $routes
        // Percorremos o array de rotas usando a Uri que está sendo chamada na requisição.
        // Se a rota em questão não for encontrada devolve-se um erro 404.
        $routes = self::$routes;
        if(!in_array(self::getRouteUri(), array_keys($routes[Request::method()]))) {
            return http_response_code(404);
        }

        // Verifica se o conteúdo da URI encotrada for do tipo Closure.
        // Se sim, então executamos essa função
        // e retornamos seu resultado como resposta.
        if(self::getRouteKey() instanceof Closure) {
            return self::getRouteKey()();
        }

        // Verifica se o conteúdo registrado na URI encontrada é um array.
        // Se sim, extrai-se o nome do controller no indíce 0 do array e método do controller no indice 1.
        // Cria-se uma instância do controller executando o método encontrado e retonando como resposta.
        if(is_array(self::getRouteKey())) {
            $controller = self::getRouteKey()[0];
            $controllerMethod = self::getRouteKey()[1];
            return (new $controller)->{$controllerMethod}();
        }

        // Verifica se o conteúdo registrado na URI contém um @.
        // Se sim, quebra-se a string extraindo o indíce 0 como controller e 1 como método.
        // Cria-se uma instância do controller executando o método encontrado e retonando como resposta.
        if(str_contains(self::getRouteKey(), '@')) {
            $controllerNamespace = "App\\Controlllers";
            $action = explode('@', trim(self::getRouteKey()));
            $controller = "{$controllerNamespace}\\{$action[0]}";
            $controllerMethod = $action[1];
            return (new $controller)->{$controllerMethod}();
        }

        // Se nenhuma das condições anteriores não for atendida.
        // Simplesmente retorna o conteúdo da URI encontrada
        // como resposta da requisição.
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
