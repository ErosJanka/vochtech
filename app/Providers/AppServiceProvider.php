<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Collaborator;
use App\Observers\GroupObserver;
use App\Observers\BrandObserver;
use App\Observers\UnitObserver;
use App\Observers\CollaboratorObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Observers do passo 12 (Group) + adicionais para atender requisito do PDF
        Group::observe(GroupObserver::class);
        Brand::observe(BrandObserver::class);
        Unit::observe(UnitObserver::class);
        Collaborator::observe(CollaboratorObserver::class);
    }
}