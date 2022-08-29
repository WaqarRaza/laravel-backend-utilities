<?php namespace Waqar\Utility\Provider;

use Waqar\Utility\Utility;
use \Illuminate\Support\ServiceProvider;

class UtilityServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton('API', \Waqar\Utility\Utility::class);
    }

    public function register()
    {

    }
}
