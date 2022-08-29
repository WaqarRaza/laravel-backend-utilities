<?php namespace Waqar\Utility\Provider;

use Waqar\Utility\Utility;

class UtilityServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
    }

    public function register()
    {
        if ($this->app instanceof \Illuminate\Foundation\Application) {
            $this->app->singleton('Utility', function () {
                return new Utility();
            });
        }
    }
}
