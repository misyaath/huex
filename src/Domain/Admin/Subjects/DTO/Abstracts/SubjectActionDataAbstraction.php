<?php

namespace Domain\Admin\Subjects\DTO\Abstracts;

use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\ActionDataFromRequest;
use Illuminate\Http\Request;

class SubjectActionDataAbstraction implements ActionData, ActionDataFromRequest
{
    public readonly string $name;
    public readonly string $description;


    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description
        ];
    }

    public function fromRequest(Request $request)
    {
        $this->name = $request->input('name');
        $this->description = $request->input('description');
    }
}
