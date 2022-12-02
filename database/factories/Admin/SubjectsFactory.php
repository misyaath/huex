<?php

namespace Database\Factories\Admin;

use Domain\Admin\Subjects\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;


class SubjectsFactory extends Factory
{

    protected $model = Subject::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph(1)
        ];
    }
}
