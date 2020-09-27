<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call;
use Call\Routes\RouteServiceProvider;
use Call\Support\Acl\AclServiceProvider;
use Call\Tenant\TenantServiceProvider;
use Call\Traits\BladeCall;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class CallServiceProvider extends BaseServiceProvider
{
    use BladeCall;

    public function register()
    {
        $this->app->register(LaravelPtBRServiceProvider::class);
        $this->app->register(TenantServiceProvider::class);
        $this->app->register(AclServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->singleton(ResponseFactory::class);
    }

    public function boot()
    {
        $this->registerViews();
        $this->registerBladeDirective();
        $this->registerRequestMacro();
        $this->registerRouterMacro();
        $this->registerMiddleware();
        $this->shareValidationErrors();
        $this->loadPublish();
        $this->installScaffolding();
        $this->publishMigrations();
        $this->publishAll();
    }

    public function registerViews(){

          $this->loadViewsFrom(base_path('packages/resources/views'), 'call-views');
    }
    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function installScaffolding()
    {
        $this->publishes([
            base_path('packages/scaffolding/') => app_path(),
        ], 'call-scaffolding');
    }

    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            base_path('packages/database/') => database_path(),
        ], 'call-migrations');
    }


    protected function loadPublish(){

        $this->publishes([
            base_path('packages/routes/web.php') => base_path('routes/web.php'),
        ], 'call-routes');

        $this->publishes([
            base_path('packages/config/call.php') => config_path('call.php'),
        ], 'call');

        $this->publishes([
            base_path('packages/resources/views') => resource_path()
        ],'call-views');

        $this->publishes([
            base_path('packages/package.json') => base_path('package.json')
        ],'call-package');

        $this->publishes([
            base_path('packages/app-assets') => public_path('_dist/admin'),
        ], 'call-app-assets');

    }

    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishAll()
    {
        $this->publishes([
            base_path('packages/database/') => database_path(),
            base_path('packages/config/call.php') => config_path('call.php'),
            base_path('packages/resources/views') => resource_path(),
            base_path('packages/package.json') => base_path('package.json'),
            base_path('packages/webpack.mix.js') => base_path('webpack.mix.js'),
            base_path('packages/app-assets') => public_path('_dist/admin'),
            base_path('packages/routes/web.php') => base_path('routes/web.php'),
        ], 'call-all');
    }
}
