<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UnitTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_unit()
    {
        $brand = Brand::factory()->create();
        $unit = Unit::factory()->create(['brand_id' => $brand->id]);

        $this->assertInstanceOf(Unit::class, $unit);
        $this->assertDatabaseHas('units', ['brand_id' => $brand->id]);
    }

    #[Test]
    public function it_belongs_to_a_brand()
    {
        $unit = Unit::factory()->create();
        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $unit->brand());
    }

    #[Test]
    public function it_has_many_collaborators()
    {
        $unit = Unit::factory()->create();
        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $unit->collaborators());
    }
}