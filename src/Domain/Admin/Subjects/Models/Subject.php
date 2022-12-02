<?php

namespace Domain\Admin\Subjects\Models;

use Domain\Admin\Subjects\Models\Traits\HasModules;
use Domain\Shared\BaseModel;

class Subject extends BaseModel
{
    use HasModules;

    protected $fillable = [
        'name',
        'description'
    ];

    protected static function newFactory()
    {
        return app(
            "Database\\Factories\\Admin\\SubjectsFactory"
        );
    }
}
