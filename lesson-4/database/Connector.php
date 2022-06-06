<?php

namespace App\Database;

use PDO;

class Connector
{
    protected PDO $database;

    public function __construct()
    {
        $databasePath = __DIR__;
        $sqliteDSN = "sqlite:$databasePath/tasks.sqlite";
        $sqliteOptions = array(PDO::ATTR_PERSISTENT => true);

        $this->database = new PDO(
            dsn: $sqliteDSN,
            options: $sqliteOptions
        );
    }

    public function connection(): PDO
    {
        return $this->database;
    }
}
