<?php

namespace Domain\Authentication\DTO;

use Carbon\Carbon;
use Domain\Admin\Classes\Models\Classes;
use Domain\Admin\Subjects\Models\Subject;
use Domain\Authentication\DTO\Abstractions\RegisterDataAbstraction;
use Domain\Shared\Interfaces\ActionDataFromRequest;
use Illuminate\Http\Request;

class TeacherRegisterData extends RegisterDataAbstraction implements ActionDataFromRequest
{
    public readonly string $firstName;
    public readonly string $lastName;
    public readonly string $email;
    public readonly string $password;
    public readonly Carbon $dateOfBirth;
    public readonly string $qualification;
    public readonly Classes $class;
    public readonly Subject $subject;
    public readonly string $role;

    public function fromRequest(Request $request)
    {
        $this->firstName = $request->input('first_name');
        $this->lastName = $request->input('last_name');
        $this->password = $request->input('password');
        $this->email = $request->input('email');
        $this->dateOfBirth = Carbon::createFromFormat('Y-m-d', $request->input('dob'));
        $this->qualification = $request->input('qualification');
        $this->class = Classes::where('id', $request->input('class'))->first();
        $this->subject = Subject::where('id', $request->input('subject'))->first();
        $this->role = $request->input('role');
    }
}
