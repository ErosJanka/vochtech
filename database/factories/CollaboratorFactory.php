<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaboratorFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->generateValidCPF(), // CPF válido
            'unit_id' => Unit::factory(),
        ];
    }

    /**
     * Gera um CPF válido para testes
     */
    private function generateValidCPF(): string
    {
        // Algoritmo simples para gerar CPF válido
        $n1 = rand(0, 9);
        $n2 = rand(0, 9);
        $n3 = rand(0, 9);
        $n4 = rand(0, 9);
        $n5 = rand(0, 9);
        $n6 = rand(0, 9);
        $n7 = rand(0, 9);
        $n8 = rand(0, 9);
        $n9 = rand(0, 9);
        
        // Calcula primeiro dígito verificador
        $d1 = $n9*2 + $n8*3 + $n7*4 + $n6*5 + $n5*6 + $n4*7 + $n3*8 + $n2*9 + $n1*10;
        $d1 = 11 - ($d1 % 11);
        if ($d1 >= 10) $d1 = 0;
        
        // Calcula segundo dígito verificador
        $d2 = $d1*2 + $n9*3 + $n8*4 + $n7*5 + $n6*6 + $n5*7 + $n4*8 + $n3*9 + $n2*10 + $n1*11;
        $d2 = 11 - ($d2 % 11);
        if ($d2 >= 10) $d2 = 0;
        
        return sprintf('%d%d%d%d%d%d%d%d%d%d%d', $n1, $n2, $n3, $n4, $n5, $n6, $n7, $n8, $n9, $d1, $d2);
    }
}