<?php

namespace Domain\Shared\traits;

use Illuminate\Database\Eloquent\Model;

trait HasModel
{
    public readonly Model $model;

    public function setBoundModel(Model $model): void
    {
        $this->model = $model;
    }
}
