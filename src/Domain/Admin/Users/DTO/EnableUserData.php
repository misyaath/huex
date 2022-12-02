<?php

namespace Domain\Admin\Users\DTO;

use Domain\Admin\Users\DTO\Abstractions\EnableDisableUserAbstraction;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\ActionDataFromRequest;

class EnableUserData extends EnableDisableUserAbstraction implements ActionData, ActionDataFromRequest
{

}
