<?php

namespace Domain\Admin\Classes\DTO\abstracts;

use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\ActionDataFromRequest;
use Illuminate\Http\Request;

abstract class ClassActionDataAbstraction implements ActionData, ActionDataFromRequest
{
    public readonly string $name;
    public readonly string $description;

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    public function fromRequest(Request $request)
    {
        $this->name = $request->input('name');
        $this->description = $request->input('description');
    }
}
