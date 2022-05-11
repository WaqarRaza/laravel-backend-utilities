<?php namespace Waqar\Utility\Provider;

use Waqar\Utility\Facade\LaravelUtil;
use Waqar\Utility\Helper;

class UtilityServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
    }

    public function register()
    {
        if ($this->app instanceof \Illuminate\Foundation\Application) {
            $this->app->singleton('LaravelUtil', function () {
                return new Helper();
            });
        }
    }
}
