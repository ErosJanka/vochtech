<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['name' => 'Grupo VochTech'],
            ['name' => 'Grupo Inovação Digital'],
            ['name' => 'Grupo Solutions TI'],
            ['name' => 'Grupo TechMaster'],
            ['name' => 'Grupo Digital Systems'],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }

        $this->command->info('✅ 5 grupos criados com sucesso!');
    }
}