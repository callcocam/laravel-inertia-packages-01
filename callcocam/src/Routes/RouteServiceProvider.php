<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Routes;

use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class RouteServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        if ($this->app->resolved('blade.compiler')) {
            $this->registerDirective($this->app['blade.compiler']);
        } else {
            $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
                $this->registerDirective($bladeCompiler);
            });
        }

        if ($this->app->runningInConsole()) {
            $this->commands(CommandRouteGenerator::class);
        }
    }

    protected function registerDirective(BladeCompiler $bladeCompiler)
    {
        $bladeCompiler->directive('routes', function ($group) {
            return app()->isLocal()
                ? "<?php echo app('" . BladeRouteGenerator::class . "')->generate({$group}); ?>"
                : app(BladeRouteGenerator::class)->generate($group);
        });
    }
}
