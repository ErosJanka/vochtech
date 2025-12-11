<?php

namespace Tests\Feature;

use App\Models\Collaborator;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ReportFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
    }

    #[Test]
    public function authenticated_user_can_view_reports_page()
    {
        $response = $this->actingAs($this->user)->get(route('reports.collaborators'));
        
        $response->assertStatus(200);
        $response->assertViewIs('reports.collaborators');
    }

    #[Test]
    public function reports_page_displays_collaborators()
    {
        Collaborator::factory()->count(5)->create();
        
        $response = $this->actingAs($this->user)->get(route('reports.collaborators'));
        
        $response->assertStatus(200);
        $response->assertViewHas('collaborators');
    }

    #[Test]
    public function reports_can_filter_by_name()
    {
        $collaborator1 = Collaborator::factory()->create(['name' => 'João Silva']);
        $collaborator2 = Collaborator::factory()->create(['name' => 'Maria Santos']);
        
        $response = $this->actingAs($this->user)->get(route('reports.collaborators', ['name' => 'João']));
        
        $response->assertStatus(200);
        $response->assertSee('João Silva');
        $response->assertDontSee('Maria Santos');
    }
}