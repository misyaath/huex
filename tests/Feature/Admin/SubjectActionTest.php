<?php

namespace Tests\Feature\Admin;

use Domain\Admin\Subjects\Actions\CreateSubjectAction;
use Domain\Admin\Subjects\Actions\DeleteSubjectAction;
use Domain\Admin\Subjects\Actions\UpdateSubjectAction;
use Domain\Admin\Subjects\DTO\CreateSubjectData;
use Domain\Admin\Subjects\DTO\DeleteSubjectData;
use Domain\Admin\Subjects\DTO\UpdateSubjectData;
use Domain\Admin\Subjects\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class SubjectActionTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    private array $dataBeforeUpdate;
    private array $data;
    private Request $request;
    private Subject $subject;

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
        $this->subject = Subject::factory()->create($this->dataBeforeUpdate);
        $this->request = Request::create('', '', $this->data);
    }

    /**
     * @test
     */
    public function canCreateSubject()
    {
        $createSubjectData = new CreateSubjectData();
        $createSubjectData->fromRequest($this->request);
        (new CreateSubjectAction(Subject::make()))->execute($createSubjectData);
        $this->assertData();
    }

    /**
     * @test
     */
    public function canUpdateSubject()
    {
        $updateSubjectData = new UpdateSubjectData();
        $updateSubjectData->fromRequest($this->request);
        $updateSubjectData->setBoundModel($this->subject);
        (new UpdateSubjectAction())->execute($updateSubjectData);

        $this->assertDataDoesNotHave();
        $this->assertData();
    }


    /**
     * @test
     */
    public function canDeleteSubject()
    {
        $deleteSubjectData = new DeleteSubjectData();
        $deleteSubjectData->setBoundModel($this->subject);
        (new DeleteSubjectAction())->execute($deleteSubjectData);
        $this->assertDataDoesNotHave();
    }

    private function assertDataDoesNotHave()
    {
        $this->assertDatabaseMissing('subjects', $this->dataBeforeUpdate);
    }

    private function assertData()
    {
        $this->assertDatabaseHas('subjects', $this->data);
    }
}
