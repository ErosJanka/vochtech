<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\ReportController;

// Redirect root to login or dashboard for a friendlier UX
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'welcome')->name('dashboard');
    Route::resource('groups', GroupController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('units', UnitController::class);
    Route::resource('collaborators', CollaboratorController::class);

    Route::get('reports/collaborators', [ReportController::class, 'collaborators'])->name('reports.collaborators');
    Route::get('reports/collaborators/export', [ReportController::class, 'export'])->name('reports.collaborators.export');
});

require __DIR__.'/auth.php';