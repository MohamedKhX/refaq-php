<?php

namespace src\app;
class Container
{
    protected static \src\database\Database $database;

    public static function getDatabase(): \src\database\Database
    {
        return static::$database;
    }

    public function __construct(\src\database\Database $database)
    {
        static::$database = $database;
    }
}