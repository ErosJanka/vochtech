<?php

namespace App\Observers;

use App\Models\Unit;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;

class UnitObserver
{
    public function created(Unit $unit): void
    {
        $this->createAudit($unit, 'created');
    }

    public function updated(Unit $unit): void
    {
        $this->createAudit($unit, 'updated');
    }

    public function deleted(Unit $unit): void
    {
        $this->createAudit($unit, 'deleted');
    }

    private function createAudit(Unit $unit, string $action): void
    {
        $user = Auth::user();

        Audit::create([
            'user_id' => $user ? $user->id : null,
            'auditable_type' => Unit::class,
            'auditable_id' => $unit->id,
            'action' => $action,
            'old' => $action === 'updated' ? json_encode($unit->getOriginal()) : null,
            'new' => json_encode($unit->getAttributes()),
        ]);
    }
}