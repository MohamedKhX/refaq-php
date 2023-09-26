<?php

namespace src\entities;

class UserSubjectsEntity extends Entity
{

    protected function setTableName(): static
    {
        $this->table_name = 'users_subjects';

        return $this;
    }
}