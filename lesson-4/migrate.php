<?php

require 'vendor/autoload.php';

use App\Core\Application;
use App\Database\Connector;
use App\Database\Migrator;
use App\Database\Migrations\CreateUsersTable;
use App\Database\Migrations\CreateTasksTable;

$app = Application::make();
$app->singleton('db', Connector::class);

Migrator::migrate(new CreateTasksTable);
Migrator::migrate(new CreateUsersTable);
