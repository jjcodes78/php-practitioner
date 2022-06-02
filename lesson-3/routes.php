<?php

Router::get('/', 'TasksController@index');

Router::post('/tasks', 'TasksController@store');

Router::get('/users', 'UsersController@index');

Router::delete('/', 'TasksController@destroy');
