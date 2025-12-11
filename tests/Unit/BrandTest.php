<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class BrandTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_brand()
    {
        $group = Group::factory()->create();
        $brand = Brand::factory()->create(['group_id' => $group->id]);

        $this->assertInstanceOf(Brand::class, $brand);
        $this->assertDatabaseHas('brands', ['group_id' => $group->id]);
    }

    #[Test]
    public function it_belongs_to_a_group()
    {
        $brand = Brand::factory()->create();
        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $brand->group());
    }

    #[Test]
    public function it_has_many_units()
    {
        $brand = Brand::factory()->create();
        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $brand->units());
    }
}