<?php

namespace Domain\Admin\Subjects\Models\Traits;

use Domain\Admin\Modules\Models\Module;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasModules
{
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }
}
