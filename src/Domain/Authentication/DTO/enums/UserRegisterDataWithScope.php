<?php

namespace Domain\Authentication\DTO\enums;

use Domain\Authentication\DTO\AdminRegisterData;
use Domain\Authentication\DTO\StudentRegisterData;
use Domain\Authentication\DTO\TeacherRegisterData;

enum UserRegisterDataWithScope: string
{
    case Teacher = TeacherRegisterData::class;
    case Student = StudentRegisterData::class;
    case Admin = AdminRegisterData::class;
}
