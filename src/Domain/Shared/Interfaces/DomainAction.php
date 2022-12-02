<?php

namespace Domain\Shared\Interfaces;

interface DomainAction
{
    public function execute(ActionData $data): void;
}
