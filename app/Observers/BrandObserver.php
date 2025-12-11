<?php

namespace App\Observers;

use App\Models\Brand;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;

class BrandObserver
{
    public function created(Brand $brand): void
    {
        $this->createAudit($brand, 'created');
    }

    public function updated(Brand $brand): void
    {
        $this->createAudit($brand, 'updated');
    }

    public function deleted(Brand $brand): void
    {
        $this->createAudit($brand, 'deleted');
    }

    private function createAudit(Brand $brand, string $action): void
    {
        $user = Auth::user();

        Audit::create([
            'user_id' => $user ? $user->id : null,
            'auditable_type' => Brand::class,
            'auditable_id' => $brand->id,
            'action' => $action,
            'old' => $action === 'updated' ? json_encode($brand->getOriginal()) : null,
            'new' => json_encode($brand->getAttributes()),
        ]);
    }
}