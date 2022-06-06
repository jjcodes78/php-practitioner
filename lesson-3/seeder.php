<?php

require 'vendor/autoload.php';

use App\Database\DbConnector;
use App\Database\Seeders\TasksTableSeeder;
use App\Database\Seeders\UsersTableSeeder;

TasksTableSeeder::populate(DbConnector::make());
UsersTableSeeder::populate(DbConnector::make());
