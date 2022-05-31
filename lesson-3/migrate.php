<?php

require 'vendor/autoload.php';

Migrator::migrate(DbConnector::make(), new CreateTasksTable);
Migrator::migrate(DbConnector::make(), new CreateUsersTable);
