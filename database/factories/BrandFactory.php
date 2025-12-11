<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'group_id' => Group::factory(),
        ];
    }
}