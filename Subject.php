<?php

class Subject
{
    public string $code;
    public string $name;
    public string $root;
    public int $units;
    public bool $status;
    public bool $allowed;
    public int $requiredUnits;

    public ?SubjectsContainer $subjectsContainer;

    public function __construct(string $code, string $name, string $root, int $units, bool $status, bool $allowed, int $requiredUnits = 0)
    {
        $this->code = $code;
        $this->name = $name;
        $this->root = $root;
        $this->units = $units;
        $this->status = $status;
        $this->allowed = $allowed;
        $this->requiredUnits = $requiredUnits;

        $this->status = $this->getStatusFromURL();
    }


    public function getStatusFromURL(): bool
    {
        return array_key_exists($this->code, $_GET);
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
            if($allowed === true) {
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

    public function hasNestedSubjects(): bool
    {
        return (bool) array_filter($this->subjectsContainer->getSubjects(), function ($item) {
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
}