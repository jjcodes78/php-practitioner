<?php

namespace App\Database;

use App\Facades\DB;

class Migrator
{
    public static function migrate(Schema $schema)
    {
        DB::connection()->exec($schema::up());
    }
}
