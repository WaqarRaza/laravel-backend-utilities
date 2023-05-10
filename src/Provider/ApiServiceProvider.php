<?php namespace Waqar\Utility\Provider;

use \Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'utilities');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/utilities'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('ApiService', \Waqar\Utility\ApiService::class);
    }
}