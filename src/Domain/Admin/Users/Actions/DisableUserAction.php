<?php

namespace Domain\Admin\Users\Actions;

use Domain\Shared\enums\UserStatus;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;

class DisableUserAction implements DomainAction
{

    public function execute(ActionData $data): void
    {
        $data->user->fill(['user_status' => UserStatus::DISABLE->value]);
        $data->user->save();
    }
}
