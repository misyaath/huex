<?php

namespace Domain\Admin\Classes\DTO;

use Domain\Shared\Interfaces\ActionBoundModel;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\traits\HasModel;

class DeleteClassData implements ActionData, ActionBoundModel
{
    use HasModel;

    public function toArray(): array
    {
        return [];
    }
}
