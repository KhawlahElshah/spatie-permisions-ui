<?php

namespace ISOMLY\SpatiePermissionsUI;

use Illuminate\Support\Facades\Facade;

class PermissionsUI extends Facade
{
    public static function routes(array $options = [])
    {
        //calls the Illuminate Router service class auth() method
        static::$app->make('router')->permissions($options);
    }
}
