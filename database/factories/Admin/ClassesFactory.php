<?php

namespace Database\Factories\Admin;

use Domain\Admin\Classes\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{

    protected $model = Classes::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph(1)
        ];
    }
}
