<?php

namespace App\Console\Commands;

use App\Services\PostgresProxyManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;
use Throwable;

class SetupPostgresDatabase extends Command
{
    protected $signature = 'db:setup-postgres';

    protected $description = 'Prepare Railway PostgreSQL (database, schema) and run migrations';

    public function handle(PostgresProxyManager $proxy): int
    {
        $proxy->ensureRunning();

        $database = env('DB_DATABASE', 'musa');
        $schema = env('DB_SCHEMA', 'public');

        try {
            $admin = $this->adminConnection();
        } catch (Throwable $exception) {
            $this->error('PostgreSQL bağlantısı kurulamadı: '.$exception->getMessage());

            return self::FAILURE;
        }

        if (! $this->databaseExists($admin, $database)) {
            $admin->exec('CREATE DATABASE "'.str_replace('"', '""', $database).'"');
            $this->info("Veritabanı oluşturuldu: {$database}");
        } else {
            $this->line("Veritabanı zaten mevcut: {$database}");
        }

        if ($schema !== 'public') {
            DB::statement('CREATE SCHEMA IF NOT EXISTS "'.$this->quoteIdentifier($schema).'"');
            $this->info("Şema oluşturuldu: {$schema}");
        }

        $this->call('migrate', ['--force' => true]);
        $this->call('storage:link');

        $this->info('PostgreSQL kurulumu tamamlandı.');

        return self::SUCCESS;
    }

    private function adminConnection(): PDO
    {
        $dsn = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s;sslmode=%s',
            $this->connectionHost(),
            $this->connectionPort(),
            env('DB_ADMIN_DATABASE', 'railway'),
            $this->connectionSslMode(),
        );

        return new PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'), [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 15,
        ]);
    }

    private function connectionHost(): string
    {
        return filter_var(env('DB_USE_SSL_PROXY', false), FILTER_VALIDATE_BOOL)
            ? (string) env('DB_PROXY_HOST', '127.0.0.1')
            : (string) env('DB_HOST');
    }

    private function connectionPort(): string
    {
        return filter_var(env('DB_USE_SSL_PROXY', false), FILTER_VALIDATE_BOOL)
            ? (string) env('DB_PROXY_PORT', '15432')
            : (string) env('DB_PORT', '5432');
    }

    private function connectionSslMode(): string
    {
        return filter_var(env('DB_USE_SSL_PROXY', false), FILTER_VALIDATE_BOOL)
            ? 'require'
            : (string) env('DB_SSLMODE', 'require');
    }

    private function databaseExists(PDO $connection, string $database): bool
    {
        $statement = $connection->prepare('SELECT 1 FROM pg_database WHERE datname = :database');
        $statement->execute(['database' => $database]);

        return (bool) $statement->fetchColumn();
    }

    private function quoteIdentifier(string $value): string
    {
        return str_replace('"', '""', $value);
    }
}
