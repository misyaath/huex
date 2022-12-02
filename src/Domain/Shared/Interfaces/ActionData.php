<?php

namespace Domain\Shared\Interfaces;

use Illuminate\Http\Request;

interface ActionData
{
    public function toArray(): array;
}
