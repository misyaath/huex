<?php

namespace Domain\Admin\Subjects\Actions;

use Domain\Shared\Interfaces\ActionBoundModel;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;

class DeleteSubjectAction implements DomainAction
{

    public function execute(ActionData $data): void
    {
        $data->model->delete();
    }
}
