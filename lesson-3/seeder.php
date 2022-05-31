<?php

require 'vendor/autoload.php';

TasksTableSeeder::populate(DbConnector::make());
UsersTableSeeder::populate(DbConnector::make());
