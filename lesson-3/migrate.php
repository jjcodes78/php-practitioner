<?php

require 'vendor/autoload.php';

Migrator::migrate(DbConnector::make());
