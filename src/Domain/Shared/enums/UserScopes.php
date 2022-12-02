<?php

namespace Domain\Shared\enums;

enum UserScopes: string
{
    case Teacher = 'teacher';
    case Admin = 'admin';
    case Student = 'student';
}
