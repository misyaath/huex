<?php

namespace Domain\Admin\Users\Actions;

use Domain\Shared\enums\UserStatus;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\DomainAction;

class EnableUserAction implements DomainAction
{

    public function execute(ActionData $data): void
    {
        $data->user->fill(['user_status' => UserStatus::ENABLE->value]);
        $data->user->save();
    }
}
