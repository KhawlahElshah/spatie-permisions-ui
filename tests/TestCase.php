<?php

namespace ISOM\SpatiePermissionsUI\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use ISOM\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use DatabaseMigrations;

    function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function setUpDatabase(Application $app)
    {
        include_once __DIR__ . '/../vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub';

        (new \CreatePermissionTables())->up();
    }

    protected function getPackageProviders($app)
    {
        return [
            SpatiePermissionsUiServiceProvider::class,
        ];
    }
}
