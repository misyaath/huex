<?php

namespace Domain\Admin\Classes\Models;

use Domain\Shared\BaseModel;

class Classes extends BaseModel
{

    protected $fillable = [
        'name',
        'description'
    ];

    protected static function newFactory()
    {
        return app(
            "Database\\Factories\\Admin\\ClassesFactory"
        );
    }
}
