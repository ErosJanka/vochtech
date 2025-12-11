<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BrandFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
    }

    #[Test]
    public function authenticated_user_can_view_brands_index()
    {
        Brand::factory()->count(3)->create();
        
        $response = $this->actingAs($this->user)->get(route('brands.index'));
        
        $response->assertStatus(200);
        $response->assertViewIs('brands.index');
        $response->assertViewHas('brands');
    }

    #[Test]
    public function authenticated_user_can_create_a_brand()
    {
        $group = Group::factory()->create();
        
        $response = $this->actingAs($this->user)->post(route('brands.store'), [
            'name' => 'Nova Bandeira',
            'group_id' => $group->id,
        ]);
        
        $response->assertRedirect(route('brands.index'));
        $this->assertDatabaseHas('brands', ['name' => 'Nova Bandeira']);
    }

    #[Test]
    public function authenticated_user_can_update_a_brand()
    {
        $brand = Brand::factory()->create();
        
        $response = $this->actingAs($this->user)->put(route('brands.update', $brand), [
            'name' => 'Bandeira Atualizada',
            'group_id' => $brand->group_id,
        ]);
        
        $response->assertRedirect(route('brands.index'));
        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => 'Bandeira Atualizada'
        ]);
    }

    #[Test]
    public function authenticated_user_can_delete_a_brand()
    {
        $brand = Brand::factory()->create();
        
        $response = $this->actingAs($this->user)->delete(route('brands.destroy', $brand));
        
        $response->assertRedirect(route('brands.index'));
        $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
    }
}