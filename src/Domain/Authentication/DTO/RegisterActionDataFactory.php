<?php

namespace Domain\Authentication\DTO;

use Domain\Authentication\DTO\enums\UserRegisterDataWithScope;
use Domain\Authentication\Exceptions\InvalidFactoryException;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\traits\HasRole;
use Illuminate\Http\Request;

class RegisterActionDataFactory
{
    use HasRole;

    protected string $instance;

    public function factory(string $role): ActionData
    {
        $this->role = $role;
        if ($this->isTeacher()) {
            $this->instance = UserRegisterDataWithScope::Teacher->value;
        } elseif ($this->isStudent()) {
            $this->instance = UserRegisterDataWithScope::Student->value;
        } elseif ($this->isAdmin()) {
            $this->instance = UserRegisterDataWithScope::Admin->value;
        } else {
            throw new InvalidFactoryException('Invalid User Register Action Data');
        }
        return new $this->instance();
    }
}
