<?php

namespace Domain\Student\Models;


use Domain\Shared\BaseModel;
use Domain\Student\Models\Traits\HasSubjects;

class Student extends BaseModel
{

    use HasSubjects;

    protected $fillable = [
        'first_name',
        'last_name',
        'class_id',
        'user_id'
    ];

    protected static function newFactory()
    {
        return app(
            "Database\\Factories\\Student\\StudentFactory"
        );
    }
}
