<?php
namespace App\Database\Seeders;

use PDO;

class TasksTableSeeder
{
    public static function populate(PDO $pdo)
    {
        $statement = $pdo->prepare("INSERT INTO tasks ('task') VALUES (?)");
        $statement->execute(["Tarefa A"]);
        $statement->execute(["Tarefa B"]);
        $statement->execute(["Tarefa C"]);
    }
}
