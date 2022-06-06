<?php

Use App\Core\Router;

Router::get('/', 'App\Controllers\TasksController@index');

Router::post('/tasks', 'App\Controllers\TasksController@store');

Router::get('/users', 'App\Controllers\TasksController@index');

Router::delete('/', 'App\Controllers\TasksController@destroy');

Router::delete('/completed', 'App\Controllers\TasksController@destroyCompleted');

Router::put('/', 'App\Controllers\TasksController@update');
