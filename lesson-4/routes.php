<?php

// Faz o "import" das classes usadas
// durante o registro das rotas.
// A classe Router é a responsável por registrar uma rota.
use App\Controllers\TasksController;
Use App\Facades\Router;

Router::get('/', [TasksController::class, 'index']);

Router::post('/tasks', 'App\Controllers\TasksController@store');

Router::get('/users', 'App\Controllers\TasksController@index');

Router::delete('/', 'App\Controllers\TasksController@destroy');

Router::delete('/completed', 'App\Controllers\TasksController@destroyCompleted');

Router::put('/', 'App\Controllers\TasksController@update');
