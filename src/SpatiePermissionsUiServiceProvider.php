<?php

namespace ISOM\SpatiePermissionsUI;

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
        $this->app->make('ISOM\SpatiePermissionsUI\PermissionController');
        $this->app->make('ISOM\SpatiePermissionsUI\RoleController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->bootResources();
        $this->publishes([
            __DIR__ . '\PermissionController.php' => app_path('Http/Controllers/PermissionController.php'),
            __DIR__ . '\RoleController.php' => app_path('Http/Controllers/RoleController.php'),
        ]);
    }

    private function bootResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'spatie-permissions-ui');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/permissions-ui'),
        ]);
    }
}
