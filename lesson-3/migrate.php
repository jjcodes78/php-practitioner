<?php

require 'vendor/autoload.php';

use App\Database\Migrator;
use App\Database\DbConnector;
use App\Database\Migrations\CreateUsersTable;
use App\Database\Migrations\CreateTasksTable;

Migrator::migrate(DbConnector::make(), new CreateTasksTable);
Migrator::migrate(DbConnector::make(), new CreateUsersTable);
