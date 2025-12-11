<?php

namespace Tests\Unit;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test; // ADICIONE ESTA LINHA
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    #[Test] // TROQUE /** @test */ POR #[Test]
    public function it_can_create_a_group()
    {
        $group = Group::create([
            'name' => 'Grupo Teste'
        ]);

        $this->assertInstanceOf(Group::class, $group);
        $this->assertEquals('Grupo Teste', $group->name);
    }

    #[Test] // TROQUE /** @test */ POR #[Test]
    public function it_has_brands_relation()
    {
        $group = Group::factory()->create();
        
        $this->assertTrue(method_exists($group, 'brands'));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $group->brands());
    }

    #[Test] // TROQUE /** @test */ POR #[Test]
    public function it_validates_required_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        
        Group::create([]);
    }
}