<?php

require __DIR__ . '/../database/pdo.php';

function tasks_getAll(): array
{
    $conn = dbConnect();
    return dbQuery($conn, "select * from tasks;");
}

function tasks_find($id): Task
{
    $conn = dbConnect();

    $query =  "select * from tasks where id = $id";

    return dbQueryFirst($conn, $query);
}
