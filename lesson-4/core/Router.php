<?php

namespace App\Core;

use App\Facades\Request;
use Closure;

class Router
{
    // coleção (array) de rotas
    protected array $routes = [
        'GET' => [], // rotas registradas com o método get
        'POST' => [], // rotas registrada com o método post
        'DELETE' => [],
        'PUT' => [],
        'PATCH' => [],
    ];

    public function get($route, $destination)
    {
        $this->routes['GET'][$route] = $destination;
    }

    public function post($route, $destination)
    {
        $this->routes['POST'][$route] = $destination;
    }

    public function patch($route, $destination)
    {
        $this->routes['PATCH'][$route] = $destination;
    }

    public function put($route, $destination)
    {
        $this->routes['PUT'][$route] = $destination;
    }

    public function delete($route, $destination)
    {
        $this->routes['DELETE'][$route] = $destination;
    }

    public function resolve()
    {
        // Antes de resolver a rota na requisição
        // importamos as rotas da aplicação registradas
        // no arquivo routes.php
        require __DIR__ . "/../routes.php";

        // Simplificamos as rotas registradas em self:routes para a variável routes
        // Percorremos o array de rotas usando a Uri que está sendo chamada na requisição.
        // Se a rota em questão não for encontrada devolve-se um erro 404.
        if(!in_array($this->getRouteUri(), array_keys($this->routes[Request::method()]))) {
            return http_response_code(404);
        }

        // Verifica se o conteúdo da URI encotrada for do tipo Closure.
        // Se sim, então executamos essa função
        // e retornamos seu resultado como resposta.
        if($this->getRouteKey() instanceof Closure) {
            return $this->getRouteKey()();
        }

        // Verifica se o conteúdo registrado na URI encontrada é um array.
        // Se sim, extrai-se o nome do controller no indíce 0 do array e método do controller no indice 1.
        // Cria-se uma instância do controller executando o método encontrado e retonando como resposta.
        if(is_array($this->getRouteKey())) {
            $controller = $this->getRouteKey()[0];
            $controllerMethod = $this->getRouteKey()[1];
            return (new $controller)->{$controllerMethod}();
        }

        // Verifica se o conteúdo registrado na URI contém um @.
        // Se sim, quebra-se a string extraindo o indíce 0 como controller e 1 como método.
        // Cria-se uma instância do controller executando o método encontrado e retonando como resposta.
        if(str_contains($this->getRouteKey(), '@')) {
            $action = explode('@', trim($this->getRouteKey()));
            $controller = $action[0];
            $controllerMethod = $action[1];
            return (new $controller)->{$controllerMethod}();
        }

        // Se nenhuma das condições anteriores não for atendida.
        // Simplesmente retorna o conteúdo da URI encontrada
        // como resposta da requisição.
        return $this->getRouteKey();
    }

    protected function getRouteUri(): string
    {
        return (Request::queryString()) ?
            str_replace("?" . Request::queryString(), "", Request::uri()) :
            Request::uri();
    }

    protected function getRouteKey(): mixed
    {
        return $this->routes[Request::method()][$this->getRouteUri()];
    }
}
