<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Traits;

use Call\Facades\Call;
use Call\Middleware;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

trait BladeCall
{

    protected function registerBladeDirective()
    {
        Blade::directive('call', function () {
           return '<div id="app" data-page="{{ json_encode($page) }}"></div>';
        });
    }

    protected function registerRequestMacro()
    {
        Request::macro('call', function () {
            return boolval($this->header('X-Inertia'));
        });
    }

    protected function registerRouterMacro()
    {
        Router::macro('call', function ($uri, $component, $props = []) {
            return $this->match(['GET', 'HEAD'], $uri, '\Call\Controller')
                ->defaults('component', $component)
                ->defaults('props', $props);
        });
    }

    protected function registerMiddleware()
    {
        $this->app[Kernel::class]->appendMiddlewareToGroup(
            Config::get('call.middleware_group', 'web'),
            Middleware::class
        );
    }

    protected function shareValidationErrors()
    {
        if (Call::getShared('errors')) {
            return;
        }
        Call::share('errors', function () {
            if (! Session::has('errors')) {
                return (object) [];
            }
            return (object) Collection::make(Session::get('errors')->getBags())->map(function ($bag) {
                return (object) Collection::make($bag->messages())->map(function ($errors) {
                    return $errors[0];
                })->toArray();
            })->pipe(function ($bags) {
                return $bags->has('default') ? $bags->get('default') : $bags->toArray();
            });
        });
    }

    protected function loadPublish(){

        $this->publishes([
            __DIR__.'/../config/lw-call.php' => config_path('lw-call.php'),
        ], 'lw-call');

        $this->publishes([
            __DIR__.'/../../resources' => resource_path()
        ],'lw-call-views');

        $this->publishes([
            __DIR__.'/../package.json' => base_path('package.json')
        ],'lw-call-package');

        $this->publishes([
            __DIR__.'/../../app-assets' => public_path('dist-assets'),
        ], 'lw-call-app-assets');

    }

}
