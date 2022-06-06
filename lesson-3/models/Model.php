<?php

namespace App\Models;

use App\Database\DbConnector;
use PDO;

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

    public static function where(array $conditions)
    {
        $instance = new static;
        $pdo = DbConnector::make();
        $whereValues = self::getWhereValues($conditions);
        $sql = "SELECT * FROM {$instance->tableName} WHERE {$whereValues} ORDER BY id DESC;";
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

    public static function update(array $conditions, array $attributes)
    {
        $instance = new static;
        $pdo = DbConnector::make();

        // Monta SET key = :key[, ]...
        $setValues = "";
        foreach ($attributes as $key => $value) {
            $setValues .= "{$key} = :{$key}, ";
        }
        $setValues = rtrim($setValues, ", ");

        // Monta as condições para o WHERE key=value [and ]...
        $whereValues = self::getWhereValues($conditions);

        // Combina tudo para montar a instrução SQL
        $sql = "UPDATE {$instance->tableName} SET {$setValues} WHERE {$whereValues}";
        $statement = $pdo->prepare($sql);

        // Percorre o array de atributes a faz o bind descrito no SET para os valores
        // a serem atualizados SET key = :key => key = value
        foreach ($attributes as $key => $value) {
            $statement->bindValue(":{$key}", $value);
        }

        $statement->execute();
    }

    public static function delete(array $conditions)
    {
        $whereValue = "";
        foreach ($conditions as $key => $value) {
            $whereValue .= "$key=$value and ";
        }
        $whereValue = rtrim($whereValue, "and ");

        $instance = new static;
        $pdo = DbConnector::make();
        $sql = "DELETE FROM {$instance->tableName} WHERE {$whereValue}";
        $pdo->exec($sql);
    }

    protected static function getWhereValues(array $conditions): string
    {
        $whereValues = "";
        foreach ($conditions as $key => $value) {
            $whereValues .= "$key=$value and ";
        }
        return rtrim($whereValues, "and ");
    }
}
