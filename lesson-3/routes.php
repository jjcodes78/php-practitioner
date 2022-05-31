<?php

Router::get('/', 'TasksController@index');

Router::post('/tasks', 'TasksController@store');
