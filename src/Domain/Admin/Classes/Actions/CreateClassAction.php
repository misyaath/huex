<?php

namespace Domain\Admin\Classes\Actions;

use Domain\Admin\Classes\Models\Classes;
use Domain\Shared\Interfaces\ActionBoundModel;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;

class CreateClassAction implements DomainAction
{
    public function execute(ActionData $data): void
    {
        $class = Classes::make();
        $class->fill($data->toArray());
        $class->save();
    }
}
