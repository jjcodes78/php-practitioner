<?php

class Migrator
{
    public static function migrate(PDO $pdo, Schema $schema)
    {
        $pdo->exec($schema::up());
    }
}
