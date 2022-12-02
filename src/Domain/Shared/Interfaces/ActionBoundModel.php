<?php

namespace Domain\Shared\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ActionBoundModel
{
    public function setBoundModel(Model $model): void;
}
