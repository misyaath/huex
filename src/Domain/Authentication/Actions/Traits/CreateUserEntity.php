<?php

namespace Domain\Authentication\Actions\Traits;

trait CreateUserEntity
{
    public abstract function saveEntity(): void;
}
