<?php

namespace Domain\Admin\Subjects\Actions;

use Domain\Shared\Interfaces\ActionBoundModel;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;

class UpdateSubjectAction implements DomainAction
{

    public function execute(ActionData $data): void
    {
        $data->model->fill($data->toArray());
        $data->model->save();
    }
}
