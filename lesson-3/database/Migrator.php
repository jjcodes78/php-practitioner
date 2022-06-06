<?php

namespace App\Database;

use PDO;

class Migrator
{
    public static function migrate(PDO $pdo, Schema $schema)
    {
        $pdo->exec($schema::up());
    }
}
