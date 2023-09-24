<?php

namespace entities;

class UserEntity extends Entity
{
    public int $id;
    public string $name;

    protected function setTableName(): static
    {
        $this->table_name = 'users';

        return $this;
    }
}