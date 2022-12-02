<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Domain\Admin\Classes\Models\Classes;
use Domain\Admin\Subjects\Models\Subject;
use Domain\Authentication\Actions\RegisterActionFactory;
use Domain\Authentication\DTO\RegisterActionDataFactory;
use Domain\Student\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StudentAuthenticationTest extends TestCase
{

    use WithFaker, RefreshDatabase;


    protected Classes $classes;
    protected Collection $subject;
    protected array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->classes = Classes::factory()->create();
        $this->subject = Subject::factory(3)->create();

        $this->data = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'class' => $this->classes->first()->id,
            'subjects' => $this->subject->pluck('id')->all(),
            'role' => 'student',
        ];
    }

    /**
     * @test
     */


    public function studentCanSignup()
    {
        $this->registerUser();

        $this->assertDatabaseHas('users', [
            'email' => $this->data['email'],
            'role' => $this->data['role']
        ]);


        $user = User::where('email', $this->data['email'])->first();

        $this->assertDatabaseHas('students', [
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'class_id' => $this->classes->first()->id,
            'user_id' => $user->id,
        ]);

        $student = Student::where('user_id', $user->id)->first();

        foreach ($this->subject as $subject) {
            $this->assertDatabaseHas('student_subject', [
                'student_id' => $student->id,
                'subject_id' => $subject->id,
            ]);
        }
    }

    protected function registerUser()
    {
        $request = Request::create('', '', $this->data);

        $signUpDataInstance = new RegisterActionDataFactory();
        $signUpData = $signUpDataInstance->factory($this->data['role']);
        $signUpData->fromRequest($request);

        $registerAction = (new RegisterActionFactory())->factory($signUpData->role);
        $registerAction->execute($signUpData);
    }
}
