<?php

namespace Domain\Student\Models\Traits;

use Domain\Admin\Subjects\Models\Subject;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasSubjects
{
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
}
