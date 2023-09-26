<?php

namespace src\database\migrations\interface;

interface MigrationInterface
{
    public function create();

    public function insertData();

    public function drop();
}