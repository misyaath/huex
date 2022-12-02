<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Domain\Admin\Users\Actions\DisableUserAction;
use Domain\Admin\Users\Actions\EnableUserAction;
use Domain\Admin\Users\DTO\DisableUserData;
use Domain\Admin\Users\DTO\EnableUserData;
use Domain\Shared\enums\UserStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class BlockAndEnableUserTest extends TestCase
{


    use WithFaker, RefreshDatabase;

    private array $data;
    private User $user;
    private Request $request;

    /**
     * @test
     */

    public function can_admin_block_user()
    {
        $this->createRequest([
            'role' => 'student',
        ]);
        $disableUserData = new DisableUserData();
        $disableUserData->fromRequest($this->request);

        $disableUserAction = new DisableUserAction();
        $disableUserAction->execute($disableUserData);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'user_status' => UserStatus::DISABLE->value
        ]);

    }

    /**
     * @test
     */

    public function can_admin_enable_user()
    {
        $this->createRequest([
            'role' => 'student',
            'user_status' => 'disable'
        ]);
        $enableUserData = new EnableUserData();
        $enableUserData->fromRequest($this->request);

        $enableUserAction = new EnableUserAction();
        $enableUserAction->execute($enableUserData);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'user_status' => UserStatus::ENABLE->value
        ]);

    }

    private function createRequest(array $data)
    {
        $this->user = User::factory()->create($data);
        $this->request = Request::create('', '', ['user_id' => $this->user->id]);
    }
}
