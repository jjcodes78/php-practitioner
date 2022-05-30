<?php

require __DIR__ . '/../repositories/tasks_repository.php';

function tasks_index(): array
{
    return tasks_getAll();
}

function tasks_show(int $id): Task
{
    return tasks_find($id);
}
