<?php

class Migrator
{
    public static function migrate(PDO $pdo)
    {
        $statement = 'CREATE TABLE IF NOT EXISTS tasks(
                        id      integer
                                constraint tasks_pk
                                primary key autoincrement,
                        task    text not null,
                        completed integer default 0
                    )';

        $pdo->exec($statement);
    }
}
