<?php

namespace Tests\Feature\Admin;

use Domain\Admin\Classes\Actions\CreateClassAction;
use Domain\Admin\Classes\Actions\DeleteClassAction;
use Domain\Admin\Classes\Actions\UpdateClassAction;
use Domain\Admin\Classes\DTO\CreateClassData;
use Domain\Admin\Classes\DTO\DeleteClassData;
use Domain\Admin\Classes\DTO\UpdateClassData;
use Domain\Admin\Classes\Models\Classes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class ClassActionsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private array $dataBeforeUpdate;
    private array $data;
    private Classes $class;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(1),
        ];
        $this->dataBeforeUpdate = [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(1),
        ];
        $this->class = Classes::factory()->create($this->dataBeforeUpdate);
        $this->request = Request::create('', '', $this->data);
    }

    /**
     * @test
     */

    public function CanCreateClasses()
    {
        $createClassData = new CreateClassData();
        $createClassData->fromRequest($this->request);
        (new CreateClassAction())->execute($createClassData);
        $this->assertData();
    }

    /**
     * @test
     */

    public function CanUpdateClasses()
    {
        $updateClassData = new UpdateClassData();
        $updateClassData->setBoundModel($this->class);
        $updateClassData->fromRequest($this->request);

        (new UpdateClassAction())->execute($updateClassData);

        $this->assertDataDoesNotHave();
        $this->assertData();
    }

    /**
     * @test
     */

    public function CanDeleteClasses()
    {
        $deleteClassData = new DeleteClassData();
        $deleteClassData->setBoundModel($this->class);
        (new DeleteClassAction())->execute($deleteClassData);
        $this->assertDataDoesNotHave();
    }

    private function assertDataDoesNotHave()
    {
        $this->assertDatabaseMissing('classes', $this->dataBeforeUpdate);
    }

    private function assertData()
    {
        $this->assertDatabaseHas('classes', $this->data);
    }

}
