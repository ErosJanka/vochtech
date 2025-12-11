<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $groups = Group::all();

        if ($groups->isEmpty()) {
            $this->command->warn('⚠️  Nenhum grupo encontrado. Execute GroupSeeder primeiro.');
            return;
        }

        $brands = [
            ['name' => 'VochTech Solutions', 'group_id' => $groups[0]->id],
            ['name' => 'VochTech Cloud', 'group_id' => $groups[0]->id],
            ['name' => 'Inovação Digital Express', 'group_id' => $groups[1]->id],
            ['name' => 'Digital Pro', 'group_id' => $groups[1]->id],
            ['name' => 'Solutions TI Enterprise', 'group_id' => $groups[2]->id],
            ['name' => 'TechMaster Plus', 'group_id' => $groups[3]->id],
            ['name' => 'Digital Systems Corp', 'group_id' => $groups[4]->id],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        $this->command->info('✅ ' . count($brands) . ' bandeiras criadas com sucesso!');
    }
}