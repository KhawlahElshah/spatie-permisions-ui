<?php

namespace ISOMLY\SpatiePermissionsUI;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ISOMLY\SpatiePermissionsUI\PermissionsUI;
use ISOMLY\SpatiePermissionsUI\RoutesPublishCommand;

class SpatiePermissionsUiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/permissionsui.php', 'permissionsui');

        $this->app->bind('permissionsui', function ($app) {
            return new PermissionsUI;
        });

        $this->app->make('ISOMLY\SpatiePermissionsUI\Http\Controllers\PermissionController');
        $this->app->make('ISOMLY\SpatiePermissionsUI\Http\Controllers\RoleController');
        $this->app->make('ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelPermissionController');
        $this->app->make('ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelRoleController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            RoutesPublishCommand::class,
        ]);

        Route::mixin(new PermissionsUI);

        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'spatie-permissions-ui');
        $this->bootResources();
        $this->publishes([
            __DIR__ . '\Http\Controllers\PermissionController.php' => app_path('Http/Controllers/PermissionController.php'),
            __DIR__ . '\Http\Controllers\RoleController.php' => app_path('Http/Controllers/RoleController.php'),
            __DIR__ . '\Http\Controllers\ModelPermissionController.php' => app_path('Http/Controllers/ModelPermissionController.php'),
            __DIR__ . '\Http\Controllers\ModelRoleController.php' => app_path('Http/Controllers/ModelRoleController.php'),
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/spatie-permissions-ui'),
        ], 'controllers');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/spatie-permissions-ui'),
        ], 'lang');

        $this->publishes([
            __DIR__ . '/../config' =>  config_path('permissionsui.php'),
        ], 'config');

        $this->registerHelpers();
    }

    private function bootResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'spatie-permissions-ui');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ], 'views');
    }

    public function registerHelpers()
    {
        if (file_exists($file = __DIR__ . '/helpers.php')) {
            require $file;
        }
    }
}
