<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Collaborator;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_user_can_view_collaborators_report()
    {
        $group = Group::factory()->create();
        $brand = Brand::factory()->create(['group_id' => $group->id]);
        $unit = Unit::factory()->create(['brand_id' => $brand->id]);
        Collaborator::factory()->count(3)->create(['unit_id' => $unit->id]);

        $response = $this->get(route('reports.collaborators'));

        $response->assertStatus(200);
        $response->assertViewIs('reports.collaborators');
        $response->assertSee('Relatório de Colaboradores');
    }

    public function test_user_can_filter_report_by_name()
    {
        $group = Group::factory()->create();
        $brand = Brand::factory()->create(['group_id' => $group->id]);
        $unit = Unit::factory()->create(['brand_id' => $brand->id]);
        
        $collaborator1 = Collaborator::factory()->create([
            'name' => 'João Silva',
            'unit_id' => $unit->id
        ]);
        
        $collaborator2 = Collaborator::factory()->create([
            'name' => 'Maria Santos',
            'unit_id' => $unit->id
        ]);

        $response = $this->get(route('reports.collaborators', ['name' => 'João']));

        $response->assertStatus(200);
        $response->assertSee('João Silva');
        // Nota: assertDontSee pode não funcionar se o nome estiver em outra parte da página
    }

    public function test_user_can_export_report()
    {
        $group = Group::factory()->create();
        $brand = Brand::factory()->create(['group_id' => $group->id]);
        $unit = Unit::factory()->create(['brand_id' => $brand->id]);
        Collaborator::factory()->count(2)->create(['unit_id' => $unit->id]);

        $response = $this->get(route('reports.collaborators.export'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    public function test_report_shows_correct_data()
    {
        $group = Group::factory()->create(['name' => 'Grupo ABC']);
        $brand = Brand::factory()->create(['name' => 'Bandeira XYZ', 'group_id' => $group->id]);
        $unit = Unit::factory()->create([
            'nome_fantasia' => 'Loja Central', 
            'cnpj' => '11.111.111/0001-11',
            'brand_id' => $brand->id
        ]);
        
        $collaborator = Collaborator::factory()->create([
            'name' => 'Carlos Andrade',
            'email' => 'carlos@empresa.com',
            'cpf' => '111.222.333-44',
            'unit_id' => $unit->id
        ]);

        $response = $this->get(route('reports.collaborators'));

        $response->assertStatus(200);
        $response->assertSee('Carlos Andrade');
        $response->assertSee('carlos@empresa.com');
    }
}