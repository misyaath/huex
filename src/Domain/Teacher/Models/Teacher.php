<?php

namespace Domain\Teacher\Models;

use Domain\Shared\BaseModel;

class Teacher extends BaseModel
{

    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'qualification',
        'class_id',
        'subject_id'
    ];

    protected static function newFactory()
    {
        return app(
            "Database\\Factories\\Teacher\\TeacherFactory"
        );
    }
}
