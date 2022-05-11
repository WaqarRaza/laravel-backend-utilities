<?php namespace Waqar\Utility\Facade;

use Illuminate\Support\Facades\Facade;

class LaravelUtil extends Facade
{
    /**
     * @method static \Waqar\Utility\Helper dashboard_stats_query()
     * @method static \Waqar\Utility\Helper store_image()
     *
     * @see \Waqar\Utility\Helper
     */
    protected static function getFacadeAccessor()
    {
        return 'LaravelUtil';
    }

}
