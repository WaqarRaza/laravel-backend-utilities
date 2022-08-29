<?php namespace Waqar\Utility\Provider;

class ApiServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind('API', \Waqar\Utility\Facade\ApiService::class);
    }
}