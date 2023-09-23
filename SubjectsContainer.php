<?php

class SubjectsContainer
{
    public array $subjects;

    public function __construct(array $subjects)
    {
        $this->subjects = $subjects;

        $this->setSubjectsContainer();

        $this->checkSubjectsStatus();
        $this->checkRequiredUnits();
    }

    public function checkSubjectsStatus(): void
    {
        foreach ($this->subjects as $subject) {
            $subject->onStatus();
        }
    }

    public function checkRequiredUnits(): void
    {
        foreach ($this->subjects as $subject) {
            $subject->checkRequiredUnits();
        }
    }

    public function setSubjectsContainer(): Static
    {
        foreach ($this->subjects as $subject) {
            $subject->setSubjectsContainer($this);
        }

        return $this;
    }

    public function getSubjects(): array
    {
        return $this->subjects;
    }

    public function enableFirstSubjects(): void
    {
        foreach ($this->subjects as $subject) {
            if ($subject->root === '') {
                $subject->allowed = true;
            }
        }
    }

    public function getTotalSubjectsCount(): int
    {
        return count($this->subjects);
    }

    public function getCompletedSubjectsCount(): int
    {

        return array_reduce($this->subjects, function ($accumulator, $currentValue) {
            if ($currentValue->status === false) {
                return $accumulator + 0;
            }

            return $accumulator + 1;
        }, 0);
    }

    public function getRemainingSubjectsCount(): int
    {
         return array_reduce($this->subjects, function ($accumulator, $currentValue) {
            if ($currentValue->status === true) {
                return $accumulator + 0;
            }

            return $accumulator + 1;
        }, 0);
    }

    public function getTotalUnitsCount(): int
    {
        return array_reduce($this->subjects, function ($accumulator, $currentValue) {
            return $accumulator + $currentValue->units;
        }, 0);
    }

    public function getCompletedUnits(): int
    {
        return array_reduce($this->subjects, function ($accumulator, $currentValue) {
            if ($currentValue->status === false) {
                return $accumulator + 0;
            }

            return $accumulator + $currentValue->units;
        }, 0);
    }

    public function getRemainingUnitsCount(): int
    {
        return array_reduce($this->subjects, function ($accumulator, $currentValue) {
            if ($currentValue->status === false) {
                return $accumulator + $currentValue->units;
            }

            return $accumulator + 0;
        }, 0);
    }
}

//The View