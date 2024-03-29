<?php namespace Waqar\Utility\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Facades\Response response($data = null, $message = '', $status = 200)
 * @method static \Illuminate\Support\Facades\Response not_found($message = '')
 * @method static boolean validate($rules, $messages = [])
 * @method static \Illuminate\Support\Facades\Response validation_errors()
 * @method static \Illuminate\Support\Facades\Response error($message = '', $status = 422)
 * @method static \Illuminate\Support\Facades\Response server_error(\Throwable $throwable)
 * @method static \Illuminate\Support\Facades\Response forbidden()
 * @method static \Illuminate\Support\Facades\Response unauthenticated()
 *
 * @see \Waqar\Utility\ApiService
 */
class ApiService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ApiService';
    }

}
