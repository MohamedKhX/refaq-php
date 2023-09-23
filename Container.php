<?php

class Container
{
    protected static \database\Database $database;

    public static function getDatabase(): \database\Database
    {
        return static::$database;
    }

    public function __construct(\database\Database $database)
    {
        static::$database = $database;
    }
}