<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use ISOMLY\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use DatabaseMigrations;

    function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function setUpDatabase($app)
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');


        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->softDeletes();
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            SpatiePermissionsUiServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('permission.table_names', [
            'roles'                 => 'roles',
            'permissions'           => 'permissions',
            'model_has_permissions' => 'model_has_permissions',
            'model_has_roles'       => 'model_has_roles',
            'role_has_permissions'  => 'role_has_permissions',
        ]);

        $app['config']->set('permission.models', [
            'permission' => \Spatie\Permission\Models\Permission::class,
            'role' => \Spatie\Permission\Models\Role::class,
        ]);

        $app['config']->set('permission.column_names', [
            'model_morph_key' => 'model_id',
        ]);

        // Use test User model for users provider
        $app['config']->set('auth.providers.users.model', User::class);
    }
}
