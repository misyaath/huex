<?php

namespace Domain\Authentication\DTO\Abstractions;

use Domain\Shared\Interfaces\ActionData;

abstract class RegisterDataAbstraction implements ActionData
{
    public function toArray(): array
    {
        return [
            'name' => $this->name(),
            'email' => $this->email,
            'role' => $this->role,
        ];
    }

    public function name(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
