<?php

namespace App\Database\Migrations;

use App\Database\Schema;

class CreateTasksTable implements Schema
{
    public static function up(): string
    {
        return 'CREATE TABLE IF NOT EXISTS tasks(
                        id      integer
                                constraint tasks_pk
                                primary key autoincrement,
                        task    text not null,
                        completed integer default 0
                )';
    }
}
