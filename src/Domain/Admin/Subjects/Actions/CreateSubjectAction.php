<?php

namespace Domain\Admin\Subjects\Actions;

use Domain\Admin\Subjects\Models\Subject;
use Domain\Shared\Interfaces\ActionBoundModel;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;

class CreateSubjectAction implements DomainAction
{

    public function __construct(public Subject $subject)
    {
    }

    public function execute(ActionData $data): void
    {
        $this->subject->fill($data->toArray());
        $this->subject->save();
    }
}
