<?php

require 'database/pdo.php';

function createTasksTable(): void
{
    $connection = dbConnect();
    $connection->exec('CREATE TABLE IF NOT EXISTS tasks(
                        id      integer
                                constraint tasks_pk
                                primary key autoincrement,
                        task    text not null,
                        completed integer default 0
                    )'
    );
}

function populateTasksTable()
{
    $connection = dbConnect();
    $connection->exec("DELETE FROM tasks;");
    // Usando exec diretamente
    $connection->exec("INSERT INTO tasks ('task') VALUES ('Task #1');");
    // Usando prepare para passar os valores em execute
    $stmt = $connection->prepare("INSERT INTO tasks ('task') VALUES (?);");
    // Inserindo um registro de uma só vez
    $stmt->execute(['Task #2']);
    foreach (['Task#3 from batch', 'Task#4 from batch'] as $task) {
        // Inserindo registro de uma coleção/array de dados
        $stmt->execute([$task]);
    }
}

createTasksTable();

populateTasksTable();
