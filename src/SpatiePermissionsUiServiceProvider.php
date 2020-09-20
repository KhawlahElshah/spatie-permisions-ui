<?php

namespace ISOMLY\SpatiePermissionsUI;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SpatiePermissionsUiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('ISOMLY\SpatiePermissionsUI\Http\Controllers\PermissionController');
        $this->app->make('ISOMLY\SpatiePermissionsUI\Http\Controllers\RoleController');
        $this->app->make('ISOMLY\SpatiePermissionsUI\Http\Controllers\UserPermissionController');
        $this->app->make('ISOMLY\SpatiePermissionsUI\Http\Controllers\UserRoleController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            InstallCommand::class,
        ]);

        Route::mixin(new PermissionsUiRouteMethods);
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'spatie-permissions-ui');
        $this->bootResources();
        $this->publishes([
            __DIR__ . '\Http\Controllers\PermissionController.php' => app_path('Http/Controllers/PermissionController.php'),
            __DIR__ . '\Http\Controllers\RoleController.php' => app_path('Http/Controllers/RoleController.php'),
            __DIR__ . '\Http\Controllers\UserPermissionController.php' => app_path('Http/Controllers/UserPermissionController.php'),
            __DIR__ . '\Http\Controllers\UserRoleController.php' => app_path('Http/Controllers/UserRoleController.php'),
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/spatie-permissions-ui'),
        ], 'controllers');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/spatie-permissions-ui'),
        ], 'lang');
    }

    private function bootResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'spatie-permissions-ui');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ], 'views');
    }
}
