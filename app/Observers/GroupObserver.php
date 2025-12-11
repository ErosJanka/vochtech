<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;

class GroupObserver
{
    public function created(Group $group): void
    {
        $this->createAudit($group, 'created');
    }

    public function updated(Group $group): void
    {
        $this->createAudit($group, 'updated');
    }

    public function deleted(Group $group): void
    {
        $this->createAudit($group, 'deleted');
    }

    private function createAudit(Group $group, string $action): void
    {
        $user = Auth::user();

        Audit::create([
            'user_id' => $user ? $user->id : null,
            'auditable_type' => Group::class,
            'auditable_id' => $group->id,
            'action' => $action,
            'old' => $action === 'updated' ? json_encode($group->getOriginal()) : null,
            'new' => json_encode($group->getAttributes()),
        ]);
    }
}