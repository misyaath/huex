<?php

namespace Domain\Admin\Classes\DTO;

use Domain\Admin\Classes\DTO\abstracts\ClassActionDataAbstraction;
use Domain\Shared\Interfaces\ActionBoundModel;
use Domain\Shared\traits\HasModel;

class UpdateClassData extends ClassActionDataAbstraction implements ActionBoundModel
{
    use HasModel;
}
