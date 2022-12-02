<?php

namespace Domain\Authentication\Actions;

use Domain\Authentication\Actions\Abstractions\RegisterActionAbstraction;
use Domain\Authentication\Actions\Traits\CreateUserEntity;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;
use Domain\Student\Models\Student;

class StudentRegisterAction extends RegisterActionAbstraction implements DomainAction
{
    use CreateUserEntity;

    protected Student $student;

    public function execute(ActionData $data): void
    {
        $this->data = $data;
        $this->registerUser();
        $this->saveEntity();
        $this->attachStudentToSubjects();
    }

    protected function saveEntity(): void
    {
        $this->student = Student::make()->fill([
            'first_name' => $this->data->firstName,
            'last_name' => $this->data->lastName,
            'class_id' => $this->data->class->id,
            'user_id' => $this->user->id,
        ]);
        $this->student->save();
    }


    protected function attachStudentToSubjects()
    {
        foreach ($this->data->subjects as $subject) {
            $this->student->subjects()->attach($subject->id);
        }
    }
}
