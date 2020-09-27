<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Tenant;

use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton("Tenant", function ($app) {
            $tenant = \App\Models\Tenant::query()->where('name',request()->getHost())->first();
            return new TenantManager($tenant);
        });
    }

    public function boot()
    {
        $this->loadMigrations();
        $this->publishMigrations();
    }
    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            base_path('packages/databases/migrations/') => database_path('migrations'),
        ], 'call-migrations');
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom( base_path('packages/databases/migrations'));
    }
}
