<?php

namespace App\Observers;

use App\Models\Collaborator;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;

class CollaboratorObserver
{
    public function created(Collaborator $collaborator): void
    {
        $this->createAudit($collaborator, 'created');
    }

    public function updated(Collaborator $collaborator): void
    {
        $this->createAudit($collaborator, 'updated');
    }

    public function deleted(Collaborator $collaborator): void
    {
        $this->createAudit($collaborator, 'deleted');
    }

    private function createAudit(Collaborator $collaborator, string $action): void
    {
        $user = Auth::user();

        Audit::create([
            'user_id' => $user ? $user->id : null,
            'auditable_type' => Collaborator::class,
            'auditable_id' => $collaborator->id,
            'action' => $action,
            'old' => $action === 'updated' ? json_encode($collaborator->getOriginal()) : null,
            'new' => json_encode($collaborator->getAttributes()),
        ]);
    }
}