<?php

namespace App\Database;

interface Schema
{
    public static function up(): string;
}
