<?php
namespace App\Database\Migrations;

use App\Database\Schema;

class CreateUsersTable implements Schema
{
    public static function up(): string
    {
        return 'CREATE TABLE IF NOT EXISTS users(
                        id      integer
                                constraint tasks_pk
                                primary key autoincrement,
                        name    text not null,
                        email    text not null
                )';
    }
}
