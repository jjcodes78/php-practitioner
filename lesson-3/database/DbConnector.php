<?php

class DbConnector
{
    public static function make(): PDO
    {
        $databasePath = __DIR__;
        $sqliteDSN = "sqlite:$databasePath/tasks.sqlite";
        $sqliteOptions = array(PDO::ATTR_PERSISTENT => true);

        return new PDO(
            dsn: $sqliteDSN,
            options: $sqliteOptions
        );
    }
}
