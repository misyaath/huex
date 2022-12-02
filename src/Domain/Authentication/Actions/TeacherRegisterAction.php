<?php

namespace Domain\Authentication\Actions;

use App\Models\User;
use Domain\Authentication\Actions\Abstractions\RegisterActionAbstraction;
use Domain\Authentication\Actions\Traits\CreateUserEntity;
use Domain\Authentication\Exceptions\TeacherAlreadyExistForSubjectAndClass;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;
use Domain\Teacher\Models\Teacher;

class TeacherRegisterAction extends RegisterActionAbstraction implements DomainAction
{
    use CreateUserEntity;

    protected ActionData $data;
    protected User $user;

    public function execute(ActionData $data): void
    {
        $this->data = $data;

        if (!is_null($this->checkTeacherAlreadyAssignedForSubjectAndClass())) {
            throw new TeacherAlreadyExistForSubjectAndClass(
                "Teacher already assigned for {$this->data->class->name} and {$this->data->subject->name}"
            );
        }

        $this->registerUser();
        $this->saveEntity();
    }

    protected function saveEntity(): void
    {
        $teacher = Teacher::make()->fill(
            [
                'first_name' => $this->data->firstName,
                'last_name' => $this->data->lastName,
                'dob' => $this->data->dateOfBirth->toDateString(),
                'qualification' => $this->data->qualification,
                'class_id' => $this->data->class->id,
                'subject_id' => $this->data->subject->id,
                'user_id' => $this->user->id,
            ]
        );
        $teacher->save();
    }

    protected function checkTeacherAlreadyAssignedForSubjectAndClass()
    {
        return Teacher::where('class_id', $this->data->class->id)
            ->where('subject_id', $this->data->subject->id)->first();
    }
}
