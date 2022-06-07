<?php

namespace App\Models;

use App\Facades\DB;
use PDO;

abstract class Model
{
    protected string $tableName;

    protected PDO $connection;

    public function __construct()
    {
        $this->connection = DB::connection();
    }

    public function all(): array|false
    {
        $sql = "SELECT * FROM {$this->tableName} ORDER BY id DESC;";
        $statement = $this->connection->query($sql);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function where(array $conditions): array|false
    {
        $whereValues = $this->getWhereValues($conditions);
        $sql = "SELECT * FROM {$this->tableName} WHERE {$whereValues} ORDER BY id DESC;";
        $statement = $this->connection->query($sql);
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function save(array $attributes): void
    {
        $keys = trim(implode(',', array_keys($attributes)), ',');
        $marks = trim(str_repeat("?,", count($attributes)), ',');
        $values = array_values($attributes);

        $sql = "INSERT INTO {$this->tableName} ({$keys}) VALUES ({$marks})";

        $statement = $this->connection->prepare($sql);
        $statement->execute($values);
    }

    public function update(array $conditions, array $attributes): void
    {
        $setValues = $this->getSetValues($attributes);
        $whereValues = $this->getWhereValues($conditions);

        $sql = "UPDATE {$this->tableName} SET {$setValues} WHERE {$whereValues}";
        $statement = $this->connection->prepare($sql);

        foreach ($attributes as $key => $value) {
            $statement->bindValue(":{$key}", $value);
        }

        $statement->execute();
    }

    public function delete(array $conditions): void
    {
        $whereValue = $this->getWhereValues($conditions);
        $sql = "DELETE FROM {$this->tableName} WHERE {$whereValue}";
        $this->connection->exec($sql);
    }

    protected function getWhereValues(array $conditions): string
    {
        $whereValues = "";
        foreach ($conditions as $key => $value) {
            $whereValues .= "$key=$value and ";
        }
        return rtrim($whereValues, "and ");
    }

    protected function getSetValues(array $attributes): string
    {
        $setValues = "";
        foreach ($attributes as $key => $value) {
            $setValues .= "{$key} = :{$key}, ";
        }
        return rtrim($setValues, ", ");
    }

    public static function on(): static
    {
        return new static;
    }
}
