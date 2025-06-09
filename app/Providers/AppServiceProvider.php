<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\DamageReport;
use App\Models\EquipmentRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app_logistik', function ($view) {
            $pendingDamageReportsCount = DamageReport::where('status', 'diajukan')->count();
            $pendingEquipmentRequestsCount = EquipmentRequest::where('status', 'diajukan')->count();
            $view->with(compact('pendingDamageReportsCount', 'pendingEquipmentRequestsCount'));
        });
    }
}
