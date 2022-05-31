<?php

abstract class Model
{
    protected $tableName;

    public static function all()
    {
        $instance = new static;
        $pdo = DbConnector::make();
        $sql = "SELECT * FROM {$instance->tableName} ORDER BY id DESC;";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public static function save(array $attributes)
    {
        $keys = trim(implode(',', array_keys($attributes)), ',');
        $marks = trim(str_repeat("?,", count($attributes)), ',');
        $values = array_values($attributes);

        $instance = new static;
        $pdo = DbConnector::make();
        $sql = "INSERT INTO {$instance->tableName} ({$keys}) VALUES ({$marks})";

        $statement = $pdo->prepare($sql);
        $statement->execute($values);
    }
}
