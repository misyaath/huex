<?php

namespace Domain\Admin\Modules\DTO;

use Domain\Admin\Subjects\Models\Subject;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\ActionDataFromRequest;
use Illuminate\Http\Request;

class ModuleCreateData implements ActionData, ActionDataFromRequest
{
    public readonly Subject $subject;
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
        $this->subject = Subject::where('id', $request->input('subject_id'))->first();
    }
}
