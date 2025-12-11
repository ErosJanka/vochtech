<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Executa seeders na ordem: grupos -> bandeiras -> unidades -> colaboradores
        $this->call([
            GroupSeeder::class,
            BrandSeeder::class,
            UnitSeeder::class,
            CollaboratorSeeder::class,
        ]);
    }
}