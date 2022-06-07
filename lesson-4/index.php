<?php

use App\Core\Application;
use App\Core\Http\Redirect;
use App\Core\Http\Request;
use App\Core\Router;
use App\Database\Connector;

use App\Facades\Router as RouterFacade;

require 'vendor/autoload.php';

// Criamos uma instância estática da aplicação com o método make.
// Essa instancia é usada para registrar as facades e permanecer
// disponível durante o ciclo de vida da aplicação
$app = Application::make();

$app->registerFacades([
    'redirect' => Redirect::class,
    'request' => Request::class,
]);

// Registra uma instância singleton (única)
// durante o ciclo de vida da aplicação
// entre a requisição e a resposta
$app->singleton('router', Router::class);
$app->singleton('db', Connector::class);

RouterFacade::resolve();
