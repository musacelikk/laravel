<?php

namespace App\Providers;

use App\Http\View\Composers\StoreComposer;
use App\Services\PostgresProxyManager;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.store', StoreComposer::class);
        View::composer('store.*', StoreComposer::class);

        Paginator::defaultView('vendor.pagination.luxe');
        Paginator::defaultSimpleView('vendor.pagination.luxe');

        if (! $this->app->runningInConsole()) {
            return;
        }

        $command = $_SERVER['argv'][1] ?? null;

        if (! in_array($command, ['serve', 'db:setup-postgres', 'migrate', 'db:seed'], true)) {
            return;
        }

        if (config('database.default') !== 'pgsql') {
            return;
        }

        $this->app->make(PostgresProxyManager::class)->ensureRunning();
    }
}
