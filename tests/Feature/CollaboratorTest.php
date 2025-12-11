<?php

namespace Tests\Unit;

use App\Models\Collaborator;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CollaboratorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_collaborator()
    {
        $unit = Unit::factory()->create();
        $collaborator = Collaborator::factory()->create(['unit_id' => $unit->id]);

        $this->assertInstanceOf(Collaborator::class, $collaborator);
        $this->assertDatabaseHas('collaborators', ['unit_id' => $unit->id]);
    }

    #[Test]
    public function it_belongs_to_a_unit()
    {
        $collaborator = Collaborator::factory()->create();
        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $collaborator->unit());
    }
}