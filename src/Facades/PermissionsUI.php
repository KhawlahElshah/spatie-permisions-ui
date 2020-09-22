<?php

namespace ISOMLY\SpatiePermissionsUI\Facades;

use Illuminate\Support\Facades\Facade;

class PermissionsUI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'permissionsui';
    }

    public static function routes(array $options = [])
    {
        static::$app->make('router')->routes($options);
    }
}
