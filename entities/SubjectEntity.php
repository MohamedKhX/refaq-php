<?php

namespace entities;
use Logic\SubjectsLogic;

class SubjectEntity extends Entity
{
    public string $code;
    public string $name;
    public string $root;
    public int $units;
    public bool $status;
    public bool $allowed;
    public int $requiredUnits;

    public ?SubjectsLogic $subjectsContainer;


    public function getStatusFromDatabase(bool $onStatus): bool
    {
        $user = UserEntity::findByKey('name', $_SESSION['user']);

        $existingRecord = UserSubjectsEntity::findByKeys([
            'user_id' => $user->id,
            'subject_code' => $this->code
        ]);

        if ($existingRecord) {
            $this->setStatus(true);
            if ($onStatus) {
                $this->onStatus();
            }
        }

        return (bool) $existingRecord;
    }

    public function onStatus(): void
    {
        if ($this->status === true) {
            $this->handleNestedStatus(true);
        } else {
            $this->handleNestedStatus(false);
        }
    }

    public function checkRequiredUnits(): void
    {
        if ($this->requiredUnits <= 0) return;
        if ($this->requiredUnits <= $this->subjectsContainer->getCompletedUnits()) {
            $this->setAllowed(true);
        } else {
            $this->setAllowed(false);
            $this->setStatus(false);
        }
    }

    public function handleNestedStatus(bool $allowed): void
    {
        $nestedSubjects = $this->getNestedSubjects();

        foreach ($nestedSubjects as $nestedSubject) {
            if ($allowed === true) {
                $nestedSubject->setAllowed(true);
                continue;
            }

            if ($nestedSubject->hasNestedSubjects()) {
                $nestedSubject->handleNestedStatus(false);
            }

            $nestedSubject->setAllowed(false);
            $nestedSubject->setStatus(false);
        }
    }

    public function getNestedSubjects(): array
    {
        return array_filter($this->subjectsContainer->getSubjects(), function ($item) {
            return $item->root === $this->code;
        });
    }

    public function getNestedSubjectFromDatabase(): array
    {
        return array_filter(static::all(), function ($item) {
            return $item->root === $this->code;
        });
    }

    public function hasNestedSubjects(): bool
    {
        return (bool)array_filter(static::all(), function ($item) {
            return $item->root === $this->code;
        });
    }

    public function setAllowed(bool $allowed): bool
    {
        return $this->allowed = $allowed;
    }


    public function setStatus(bool $status): bool
    {
        return $this->status = $status;
    }

    public function setSubjectsContainer($subjectContainer): void
    {
        $this->subjectsContainer = $subjectContainer;
    }

    protected function setTableName(): static
    {
        $this->table_name = 'subjects';

        return $this;
    }
}