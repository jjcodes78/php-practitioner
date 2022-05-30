<?php

$databasePath = __DIR__ . '/database';

return [
    'db_dsn' => "sqlite:$databasePath/tasks.sqlite",
    'db_user' => null,
    'db_password' => null,
    'db_options' => [
        PDO::ATTR_PERSISTENT => true
    ]

];
