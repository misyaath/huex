<?php

namespace Domain\Shared\traits;

use Domain\Shared\enums\UserScopes;

trait HasRole
{
    protected string $role;

    private function isTeacher(): bool
    {
        return UserScopes::Teacher->value === $this->role;
    }

    private function isStudent(): bool
    {
        return UserScopes::Student->value === $this->role;
    }

    private function isAdmin(): bool
    {
        return UserScopes::Admin->value === $this->role;
    }
}
