<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Domain\Admin\Classes\Models\Classes;
use Domain\Admin\Subjects\Models\Subject;
use Domain\Authentication\Actions\RegisterActionFactory;
use Domain\Authentication\DTO\RegisterActionDataFactory;
use Domain\Authentication\Exceptions\TeacherAlreadyExistForSubjectAndClass;
use Domain\Teacher\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class TeacherAuthenticationTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    protected Classes $classes;
    protected Subject $subject;
    protected array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->classes = Classes::factory()->create();
        $this->subject = Subject::factory()->create();
        $this->data = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'dob' => $this->faker->date(),
            'qualification' => $this->faker->sentence(),
            'class' => $this->classes->first()->id,
            'subject' => $this->subject->first()->id,
            'role' => 'teacher',
        ];
    }

    /**
     * @test
     */


    public function teachersCanSignup()
    {

        $this->registerUser();

        $this->assertDatabaseHas('users', [
            'email' => $this->data['email'],
            'role' => $this->data['role']
        ]);

        $this->assertDatabaseHas('teachers', [
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'dob' => $this->data['dob'],
            'qualification' => $this->data['qualification'],
            'class_id' => $this->classes->first()->id,
            'subject_id' => $this->subject->first()->id,
        ]);
    }


    /**
     * @test
     */
    public function teacher_cant_register_if_already_class_and_subject_have_teacher()
    {
        $this->expectException(TeacherAlreadyExistForSubjectAndClass::class);

        $userData = [
            'email' => $this->faker->email(),
            'role' => 'teacher',
        ];

        $user = User::factory()->create($userData);

        $teacherData = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'dob' => $this->faker->date(),
            'qualification' => $this->faker->sentence(),
            'class_id' => $this->classes->first()->id,
            'subject_id' => $this->subject->first()->id,
            'user_id' => $user->id,
        ];

        Teacher::factory()->create($teacherData);
        $this->registerUser();
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
