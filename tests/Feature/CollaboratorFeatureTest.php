<?php

namespace Tests\Feature;

use App\Models\Collaborator;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CollaboratorFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
    }

    #[Test]
    public function authenticated_user_can_view_collaborators_index()
    {
        Collaborator::factory()->count(3)->create();
        
        $response = $this->actingAs($this->user)->get(route('collaborators.index'));
        
        $response->assertStatus(200);
        $response->assertViewIs('collaborators.index');
        $response->assertViewHas('collaborators');
    }

    #[Test]
    public function authenticated_user_can_create_a_collaborator()
    {
        $unit = Unit::factory()->create();
        
        // CPF válido para teste (apenas números)
        $cpf = $this->generateValidCPF();
        
        $response = $this->actingAs($this->user)->post(route('collaborators.store'), [
            'name' => 'Novo Colaborador',
            'email' => 'novo@email.com',
            'cpf' => $cpf,
            'unit_id' => $unit->id,
        ]);
        
        $response->assertRedirect(route('collaborators.index'));
        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('collaborators', [
            'name' => 'Novo Colaborador',
            'email' => 'novo@email.com',
            'cpf' => $cpf,
        ]);
    }

    #[Test]
    public function authenticated_user_can_update_a_collaborator()
    {
        $collaborator = Collaborator::factory()->create();
        
        // Usa o mesmo CPF (já é válido) ou gera um novo
        $newCPF = $this->generateValidCPF();
        
        $response = $this->actingAs($this->user)->put(route('collaborators.update', $collaborator), [
            'name' => 'Colaborador Atualizado',
            'email' => 'atualizado@email.com',
            'cpf' => $newCPF, // Novo CPF válido
            'unit_id' => $collaborator->unit_id,
        ]);
        
        $response->assertRedirect(route('collaborators.index'));
        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('collaborators', [
            'id' => $collaborator->id,
            'name' => 'Colaborador Atualizado',
            'email' => 'atualizado@email.com',
            'cpf' => $newCPF,
        ]);
    }

    #[Test]
    public function authenticated_user_can_delete_a_collaborator()
    {
        $collaborator = Collaborator::factory()->create();
        
        $response = $this->actingAs($this->user)->delete(route('collaborators.destroy', $collaborator));
        
        $response->assertRedirect(route('collaborators.index'));
        $response->assertSessionHas('success');
        
        $this->assertDatabaseMissing('collaborators', ['id' => $collaborator->id]);
    }

    /**
     * Helper para gerar CPF válido nos testes
     */
    private function generateValidCPF(): string
    {
        do {
            $n1 = rand(0, 9);
            $n2 = rand(0, 9);
            $n3 = rand(0, 9);
            $n4 = rand(0, 9);
            $n5 = rand(0, 9);
            $n6 = rand(0, 9);
            $n7 = rand(0, 9);
            $n8 = rand(0, 9);
            $n9 = rand(0, 9);
            
            $d1 = $n9*2 + $n8*3 + $n7*4 + $n6*5 + $n5*6 + $n4*7 + $n3*8 + $n2*9 + $n1*10;
            $d1 = 11 - ($d1 % 11);
            if ($d1 >= 10) $d1 = 0;
            
            $d2 = $d1*2 + $n9*3 + $n8*4 + $n7*5 + $n6*6 + $n5*7 + $n4*8 + $n3*9 + $n2*10 + $n1*11;
            $d2 = 11 - ($d2 % 11);
            if ($d2 >= 10) $d2 = 0;
            
            $cpf = sprintf('%d%d%d%d%d%d%d%d%d%d%d', $n1, $n2, $n3, $n4, $n5, $n6, $n7, $n8, $n9, $d1, $d2);
        } while (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)); // Evita CPFs inválidos como 11111111111
        
        return $cpf;
    }
}