<?php

namespace Domain\Authentication\Actions;

use Domain\Authentication\Actions\enums\UserRegisterActionWithScope;
use Domain\Authentication\Exceptions\InvalidFactoryException;
use Domain\Shared\Interfaces\DomainAction;
use Domain\Shared\traits\HasRole;

class RegisterActionFactory
{
    use HasRole;

    protected string $instance;

    public function factory(string $role): DomainAction
    {
        $this->role = $role;
        if ($this->isTeacher()) {
            $this->instance = UserRegisterActionWithScope::Teacher->value;
        } elseif ($this->isStudent()) {
            $this->instance = UserRegisterActionWithScope::Student->value;
        } elseif ($this->isAdmin()) {
            $this->instance = UserRegisterActionWithScope::Admin->value;
        } else {
            throw new InvalidFactoryException('Invalid User Register Action');
        }
        return new $this->instance();
    }


}
