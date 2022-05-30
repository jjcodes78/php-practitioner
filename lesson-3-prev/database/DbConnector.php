<?php

class DbConnector
{
    public static function make(): PDO
    {
        $config = require(__DIR__ . '/../config.php');

        return new PDO(
            $config['db_dsn'],
            $config['db_user'],
            $config['db_password'],
            $config['db_options']
        );
    }
}
