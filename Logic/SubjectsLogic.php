<?php

namespace Logic;
use entities\SubjectEntity;

class SubjectsLogic
{
    public array $subjects;

    public function __construct(array $subjects)
    {
        $this->subjects = $subjects;

        $this->checkSubjectsStatus();
    }


    public function checkRequiredUnits(): void
    {
        foreach ($this->subjects as $subject) {
            if ($subject->requiredUnits <= 0) continue;
            if ($subject->requiredUnits <= $this->getCompletedUnits()) {
                $subject->setAllowed(true);
            }
            else {
                $subject->setAllowed(false);
                $subject->setStatus(false);
            }
        }
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

    public function enableUsersSubjects(): void
    {
        foreach ($this->subjects as $subject) {
            $subject->setStatus($subject->getStatusFromDatabase());
        }
    }


    public function checkSubjectsStatus(): void
    {
        foreach ($this->subjects as $subject) {
            $this->onSubjectStatus($subject);
        }
    }

    public function onSubjectStatus(SubjectEntity $subjectEntity): void
    {
        if ($subjectEntity->status === true) {
            $this->handleNestedStatus($subjectEntity, true);
        } else {
            $this->handleNestedStatus($subjectEntity, false);
        }
    }

    public function handleNestedStatus(SubjectEntity $subjectEntity, bool $allowed): void
    {
        $nestedSubjects = $this->getNestedSubjects($subjectEntity);

        foreach ($nestedSubjects as $nestedSubject) {
            if ($allowed === true) {
                $nestedSubject->setAllowed(true);
                continue;
            }

            $nestedSubject->setAllowed(false);
            $nestedSubject->setStatus(false);

            if ($nestedSubject->hasNestedSubjects()) {
                $this->handleNestedStatus($nestedSubject,false);
            }
        }
    }

    public function getNestedSubjects(SubjectEntity $subjectEntity): array
    {
        return array_filter($this->getSubjects(), function ($item) use ($subjectEntity) {
            return $item->root === $subjectEntity->code;
        });
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
