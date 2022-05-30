<?php

require __DIR__ . '/../models/Task.php';

function dbConnect(): PDO
{
    $databasePath = __DIR__;
    $sqliteDSN = "sqlite:$databasePath/tasks.db";
    $sqliteOptions = array(PDO::ATTR_PERSISTENT => true);

//    $mysqlDSN = "mysql:host=127.0.0.1;port=3306;dbname=todolist";
//    $mysqlUser = "laravel";
//    $mysqlPassword = "password";
//    $mysqlOptions = array(
//        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
//    );

    return new PDO(
        $sqliteDSN,
        null,
        null,
        $sqliteOptions
    );
}

function dbQuery(PDO $connection, string $sql): array
{
    $stmt = $connection->query($sql, PDO::FETCH_CLASS, Task::class);
    return $stmt->fetchAll();
}

function dbQueryFirst(PDO $connection, string $sql): Task
{
    $stmt = $connection->query($sql, PDO::FETCH_CLASS, Task::class);
    return $stmt->fetch();
}



