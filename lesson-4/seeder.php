<?php

require 'vendor/autoload.php';

use App\Core\Application;
use App\Database\Connector;
use App\Database\Seeders\TasksTableSeeder;
use App\Database\Seeders\UsersTableSeeder;

$app = Application::make();
$app->singleton('db', Connector::class);

TasksTableSeeder::populate();
UsersTableSeeder::populate();
