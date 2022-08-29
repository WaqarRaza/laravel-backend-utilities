<?php namespace Waqar\Utility\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string dashboard_stats_query(string $table, string $operation, string $column, string $extra_wheres = '', string $method = 'weekly', array $dates = [])
 * @method static string store_image(\Illuminate\Http\UploadedFile $file, string $path, bool $return_full_path = false)
 * @method static string update_image(\Illuminate\Http\UploadedFile $file, string $path, string $old, bool $return_full_path = false)
 *
 * @see \Waqar\Utility\Utility
 */
class Utility extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Utility';
    }

}
