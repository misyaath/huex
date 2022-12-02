<?php

namespace Tests\Feature\Authentication;

use Domain\Authentication\Actions\RegisterActionFactory;
use Domain\Authentication\DTO\RegisterActionDataFactory;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected array $data;
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'role' => 'admin',
        ];

        $this->command = \Mockery::mock(Command::class);
    }

    /**
     * @test
     */


    public function adminCanSignup()
    {
        $this->registerUser();

        $this->assertDatabaseHas('users', [
            'email' => $this->data['email'],
            'role' => $this->data['role']
        ]);
    }

    protected function registerUser()
    {

        $this->command->password = $this->data['password'];
        $this->command->lastName = $this->data['last_name'];
        $this->command->firstName = $this->data['first_name'];
        $this->command->email = $this->data['email'];
        $this->command->role = $this->data['role'];

        $signUpDataInstance = new RegisterActionDataFactory();
        $signUpData = $signUpDataInstance->factory($this->data['role']);
        $signUpData->fromCommand($this->command);

        $registerAction = (new RegisterActionFactory())->factory($signUpData->role);
        $registerAction->execute($signUpData);
    }
}
