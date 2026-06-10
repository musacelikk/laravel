<?php

namespace App\Services;

use Illuminate\Support\Facades\Process;
use RuntimeException;

class PostgresProxyManager
{
    public function ensureRunning(): void
    {
        if (! filter_var(env('DB_USE_SSL_PROXY', false), FILTER_VALIDATE_BOOL)) {
            return;
        }

        $host = env('DB_PROXY_HOST', '127.0.0.1');
        $port = (int) env('DB_PROXY_PORT', 15432);

        if ($this->isPortOpen($host, $port)) {
            return;
        }

        $script = base_path('scripts/postgres-proxy.mjs');

        if (! is_file($script)) {
            throw new RuntimeException('PostgreSQL proxy script not found.');
        }

        Process::path(base_path())
            ->env($this->proxyEnvironment())
            ->start(['node', $script]);

        for ($attempt = 0; $attempt < 30; $attempt++) {
            if ($this->isPortOpen($host, $port)) {
                return;
            }

            usleep(200_000);
        }

        throw new RuntimeException('PostgreSQL SSL proxy could not be started.');
    }

    /**
     * @return array<string, string>
     */
    private function proxyEnvironment(): array
    {
        return [
            'DB_HOST' => (string) env('DB_HOST'),
            'DB_PORT' => (string) env('DB_PORT', '5432'),
            'DB_PROXY_HOST' => (string) env('DB_PROXY_HOST', '127.0.0.1'),
            'DB_PROXY_PORT' => (string) env('DB_PROXY_PORT', '15432'),
        ];
    }

    private function isPortOpen(string $host, int $port): bool
    {
        $socket = @fsockopen($host, $port, $errorCode, $errorMessage, 1);

        if ($socket === false) {
            return false;
        }

        fclose($socket);

        return true;
    }
}
