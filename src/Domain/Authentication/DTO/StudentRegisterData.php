<?php

namespace Domain\Authentication\DTO;

use Carbon\Carbon;
use Domain\Admin\Classes\Models\Classes;
use Domain\Admin\Subjects\Models\Subject;
use Domain\Authentication\DTO\Abstractions\RegisterDataAbstraction;
use Domain\Shared\Interfaces\ActionData;
use Domain\Shared\Interfaces\ActionDataFromRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StudentRegisterData extends RegisterDataAbstraction implements ActionDataFromRequest
{
    public readonly string $firstName;
    public readonly string $lastName;
    public readonly string $email;
    public readonly string $password;
    public readonly Classes $class;
    public readonly string $role;
    public readonly Collection $subjects;

    public function fromRequest(Request $request)
    {
        $this->firstName = $request->input('first_name');
        $this->lastName = $request->input('last_name');
        $this->password = $request->input('password');
        $this->email = $request->input('email');
        $this->class = Classes::where('id', $request->input('class'))->first();
        $this->subjects = Subject::whereIn('id', $request->input('subjects'))->get();
        $this->role = $request->input('role');
    }


}
