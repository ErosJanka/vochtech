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
        // Registra observers para auditoria automática em modelos
        Group::observe(GroupObserver::class);
        Brand::observe(BrandObserver::class);
        Unit::observe(UnitObserver::class);
        Collaborator::observe(CollaboratorObserver::class);
    }
}