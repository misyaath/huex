<?php

namespace Domain\Shared\Interfaces;

use Illuminate\Console\Command;

interface ActionDataFromConsole
{
    public function fromCommand(Command $command);
}
