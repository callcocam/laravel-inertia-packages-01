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
        $this->loadMigrations();
        $this->publishAll();
    }

    public function registerViews(){

          $this->loadViewsFrom( __DIR__.'/../resources/views', 'call-views');
    }
    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function installScaffolding()
    {
        $this->publishes([
            __DIR__.'/../scaffolding/' => app_path(),
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
            __DIR__.'/../databases/' => database_path(),
        ], 'call-migrations');
    }


    protected function loadPublish(){

        $this->publishes([
            __DIR__.'/../routes/web.php' => base_path('routes/web.php'),
        ], 'call-routes');

        $this->publishes([
            __DIR__.'/../config/call.php' => config_path('call.php'),
        ], 'call');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path()
        ],'call-views');

        $this->publishes([
            __DIR__.'/../package.json' => base_path('package.json')
        ],'call-package');

    }

    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishAll()
    {
        $this->publishes([
           __DIR__.'/../databases/' => database_path(),
            __DIR__.'/../config/call.php' => config_path('call.php'),
           __DIR__.'/../resources/views' => resource_path(),
            __DIR__.'/../package.json' => base_path('package.json'),
            __DIR__.'/../webpack.mix.js' => base_path('webpack.mix.js'),
           __DIR__.'/../routes/web.php' => base_path('routes/web.php'),
        ], 'call-all');
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(  __DIR__.'/../databases/migrations');
    }
}
