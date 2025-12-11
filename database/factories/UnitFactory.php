<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    public function definition()
    {
        return [
            'nome_fantasia' => $this->faker->company,
            'razao_social' => $this->faker->company . ' LTDA',
            'cnpj' => $this->faker->unique()->numerify('##.###.###/####-##'),
            'brand_id' => Brand::factory(),
        ];
    }
}