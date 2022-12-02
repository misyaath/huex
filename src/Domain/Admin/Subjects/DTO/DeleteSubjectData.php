<?php

namespace Domain\Admin\Subjects\DTO;

use Domain\Admin\Subjects\DTO\Abstracts\SubjectActionDataAbstraction;
use Domain\Shared\Interfaces\ActionBoundModel;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\traits\HasModel;

class DeleteSubjectData  implements ActionBoundModel, ActionData
{
    use HasModel;

    public function toArray(): array
    {
        return [];
    }
}
