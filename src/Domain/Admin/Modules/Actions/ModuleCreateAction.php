<?php

namespace Domain\Admin\Modules\Actions;

use Domain\Admin\Modules\Models\Module;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;

class ModuleCreateAction implements DomainAction
{

    public function execute(ActionData $data): void
    {
        $module = new Module($data->toArray());
        $data->subject->modules()->save($module);
    }
}
