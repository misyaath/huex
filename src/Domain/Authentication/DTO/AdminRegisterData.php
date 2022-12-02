<?php

namespace Domain\Authentication\DTO;

use Domain\Authentication\DTO\Abstractions\RegisterDataAbstraction;
use Domain\Shared\Interfaces\ActionDataFromConsole;
use Illuminate\Console\Command;

class AdminRegisterData extends RegisterDataAbstraction implements ActionDataFromConsole
{
    public readonly string $firstName;
    public readonly string $lastName;
    public readonly string $email;
    public readonly string $password;
    public readonly string $role;

    public function fromCommand(Command $command)
    {
        $this->password = $command->password;
        $this->lastName = $command->lastName;
        $this->firstName = $command->firstName;
        $this->email = $command->email;
        $this->role = $command->role;
    }
}
