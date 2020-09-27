<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call;

use Illuminate\Support\ServiceProvider;

class LaravelPtBRServiceProvider extends ServiceProvider
{
    /**
    * Publishes translation files.
    *
    * @return  void
    */
    public function register()
    {
        $this->loadJsonTranslationsFrom(base_path('packages/resources/lang/pt_BR.json'));
        $this->loadTranslationsFrom(base_path('packages/resources/lang/pt_BR'),'laravel-pt-br');
        $this->publishes([
            base_path('packages/resources/lang') => resource_path('lang/pt_BR.json'),
            base_path('packages/resources/lang/pt_BR')=> resource_path('lang/pt_BR'),
        ], 'laravel-pt-br-localization');
    }
}
