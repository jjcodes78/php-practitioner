<?php
namespace App\Database\Seeders;

use App\Facades\DB;

class TasksTableSeeder
{
    public static function populate()
    {
        $statement = DB::connection()->prepare("INSERT INTO tasks ('task') VALUES (?)");
        $statement->execute(["Tarefa A"]);
        $statement->execute(["Tarefa B"]);
        $statement->execute(["Tarefa C"]);
    }
}
