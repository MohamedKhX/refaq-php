<?php

namespace entities;

class UserSubjectsEntity extends Entity
{

    protected function setTableName(): static
    {
        $this->table_name = 'users_subjects';

        return $this;
    }
}