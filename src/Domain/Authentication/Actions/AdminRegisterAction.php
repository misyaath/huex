<?php

namespace Domain\Authentication\Actions;

use Domain\Authentication\Actions\Abstractions\RegisterActionAbstraction;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;

class AdminRegisterAction extends RegisterActionAbstraction implements DomainAction
{

    public function execute(ActionData $data): void
    {
        $this->data = $data;
        $this->registerUser();
    }
}
