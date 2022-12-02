<?php

namespace Domain\Authentication\Actions\enums;

use Domain\Authentication\Actions\AdminRegisterAction;
use Domain\Authentication\Actions\StudentRegisterAction;
use Domain\Authentication\Actions\TeacherRegisterAction;

enum UserRegisterActionWithScope: string
{
    case Teacher = TeacherRegisterAction::class;
    case Student = StudentRegisterAction::class;
    case Admin = AdminRegisterAction::class;
}
