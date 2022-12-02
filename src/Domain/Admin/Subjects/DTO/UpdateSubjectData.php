<?php

namespace Domain\Admin\Subjects\DTO;

use Domain\Admin\Subjects\DTO\Abstracts\SubjectActionDataAbstraction;
use Domain\Shared\Interfaces\ActionBoundModel;
use Domain\Shared\traits\HasModel;

class UpdateSubjectData extends SubjectActionDataAbstraction implements ActionBoundModel
{
    use HasModel;
}
