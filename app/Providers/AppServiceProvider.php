<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Dosen;
use App\Models\Mapel;
use App\Observers\ActivityLogObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Dosen::observe(ActivityLogObserver::class);
        Mapel::observe(ActivityLogObserver::class);
    }
}