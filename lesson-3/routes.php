<?php

Router::get('/', function () {
    return view('index');
});

Router::get('/tasks', 'TasksController@index');

Router::post('/tasks', 'TasksController@store');
