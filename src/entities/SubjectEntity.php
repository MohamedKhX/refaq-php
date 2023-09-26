<?php

namespace src\entities;

class SubjectEntity extends Entity
{
    public string $code;
    public string $name;
    public string $root;
    public int $units;
    public bool $status;
    public bool $allowed;
    public int $requiredUnits;

    protected function setTableName(): static
    {
        $this->table_name = 'subjects';

        return $this;
    }

    public function getStatusFromDatabase(): bool
    {
        $user = UserEntity::findByKey('name', $_SESSION['user']);

        $existingRecord = UserSubjectsEntity::findByKeys([
            'user_id' => $user->id,
            'subject_code' => $this->code
        ]);

        return (bool) $existingRecord;
    }

    public function setAllowed(bool $allowed): bool
    {
        return $this->allowed = $allowed;
    }

    public function setStatus(bool $status): bool
    {
        return $this->status = $status;
    }

    public function hasNestedSubjects(): bool
    {
        return (bool) array_filter(static::all(), function ($item) {
            return $item->root === $this->code;
        });
    }
}