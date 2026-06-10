<?php

namespace App\Providers;

use App\Services\PostgresProxyManager;
use Illuminate\Support\ServiceProvider;

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
