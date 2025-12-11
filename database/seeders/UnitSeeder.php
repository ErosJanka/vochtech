<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::all();

        if ($brands->isEmpty()) {
            $this->command->warn('⚠️  Nenhuma bandeira encontrada. Execute BrandSeeder primeiro.');
            return;
        }

        $units = [
            [
                'nome_fantasia' => 'VochTech Unidade Centro',
                'razao_social' => 'VochTech Soluções em TI LTDA',
                'cnpj' => '12.345.678/0001-90',
                'brand_id' => $brands[0]->id,
            ],
            [
                'nome_fantasia' => 'VochTech Unidade Zona Sul',
                'razao_social' => 'VochTech Cloud Services LTDA',
                'cnpj' => '23.456.789/0001-01',
                'brand_id' => $brands[1]->id,
            ],
            [
                'nome_fantasia' => 'Digital Express Filial',
                'razao_social' => 'Inovação Digital Express ME',
                'cnpj' => '34.567.890/0001-12',
                'brand_id' => $brands[2]->id,
            ],
            [
                'nome_fantasia' => 'Digital Pro Matriz',
                'razao_social' => 'Digital Pro Tecnologia SA',
                'cnpj' => '45.678.901/0001-23',
                'brand_id' => $brands[3]->id,
            ],
            [
                'nome_fantasia' => 'Solutions TI Sede',
                'razao_social' => 'Solutions TI Enterprise EIRELI',
                'cnpj' => '56.789.012/0001-34',
                'brand_id' => $brands[4]->id,
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }

        $this->command->info('✅ ' . count($units) . ' unidades criadas com sucesso!');
    }
}