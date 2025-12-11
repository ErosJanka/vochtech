<?php

namespace Database\Seeders;

use App\Models\Collaborator;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollaboratorSeeder extends Seeder
{
    public function run(): void
    {
        $units = Unit::all();

        if ($units->isEmpty()) {
            $this->command->warn('⚠️  Nenhuma unidade encontrada. Execute UnitSeeder primeiro.');
            return;
        }

        $collaborators = [
            [
                'name' => 'João Silva',
                'email' => 'joao.silva@exemplo.com',
                'cpf' => '123.456.789-00',
                'unit_id' => $units[0]->id,
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@exemplo.com',
                'cpf' => '234.567.890-11',
                'unit_id' => $units[0]->id,
            ],
            [
                'name' => 'Carlos Oliveira',
                'email' => 'carlos.oliveira@exemplo.com',
                'cpf' => '345.678.901-22',
                'unit_id' => $units[1]->id,
            ],
            [
                'name' => 'Ana Pereira',
                'email' => 'ana.pereira@exemplo.com',
                'cpf' => '456.789.012-33',
                'unit_id' => $units[1]->id,
            ],
            [
                'name' => 'Pedro Costa',
                'email' => 'pedro.costa@exemplo.com',
                'cpf' => '567.890.123-44',
                'unit_id' => $units[2]->id,
            ],
            [
                'name' => 'Fernanda Lima',
                'email' => 'fernanda.lima@exemplo.com',
                'cpf' => '678.901.234-55',
                'unit_id' => $units[3]->id,
            ],
            [
                'name' => 'Ricardo Souza',
                'email' => 'ricardo.souza@exemplo.com',
                'cpf' => '789.012.345-66',
                'unit_id' => $units[4]->id,
            ],
        ];

        foreach ($collaborators as $collaborator) {
            Collaborator::create($collaborator);
        }

        $this->command->info('✅ ' . count($collaborators) . ' colaboradores criados com sucesso!');
    }
}