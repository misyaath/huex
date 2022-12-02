<?php

namespace Domain\Admin\Users\DTO;

use Domain\Admin\Users\DTO\Abstractions\EnableDisableUserAbstraction;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\ActionDataFromRequest;

class DisableUserData extends EnableDisableUserAbstraction implements ActionData, ActionDataFromRequest
{


}
