<?php namespace Waqar\Utility\Provider;

use \Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton('API', \Waqar\Utility\ApiService::class);
    }

    public function register()
    {

    }
}