<?php
namespace App\Database\Seeders;

use App\Facades\DB;

class UsersTableSeeder
{
    public static function populate()
    {
        $statement = DB::connection()->prepare("INSERT INTO users ('name', 'email') VALUES (?, ?)");
        $statement->execute(["Jorge", "jorge@test.com"]);
        $statement->execute(["Rodrigo", "rodrigo@test.com"]);
    }
}
