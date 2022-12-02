<?php

namespace Tests\Feature\Admin;

use Domain\Admin\Modules\Actions\ModuleCreateAction;
use Domain\Admin\Modules\DTO\ModuleCreateData;
use Domain\Admin\Subjects\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class AdminModuleActionTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function admin_can_add_module_to_subject()
    {
        $subject = Subject::factory()->create();
        $module = [
            'subject_id' => $subject->id,
            'name' => $this->faker->sentence(),
            'description' => $this->faker->password(1),
        ];

        $request = Request::create('', '', $module);

        $moduleCreateActionData = new ModuleCreateData();
        $moduleCreateActionData->fromRequest($request);

        $moduleCreateAction = new ModuleCreateAction();
        $moduleCreateAction->execute($moduleCreateActionData);

        $this->assertDatabaseHas('modules', $module);
    }
}
