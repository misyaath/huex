<?php

namespace Domain\Admin\Modules\Models;

use Domain\Shared\BaseModel;

class Module extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'subject_id'
    ];
}
