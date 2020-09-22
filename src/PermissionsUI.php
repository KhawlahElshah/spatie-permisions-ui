<?php

namespace ISOMLY\SpatiePermissionsUI;

use Illuminate\Support\Facades\Route;

class PermissionsUI
{
    /**
     * Register the permissions ui routes.
     * 
     * @return callable
     */
    public function routes()
    {
        return function ($options = []) {

            Route::group(['middleware' => ['web']], function () use ($options) {
                Route::resource('permissions', \ISOMLY\SpatiePermissionsUI\Http\Controllers\PermissionController::class)->except('show');
                Route::resource('roles', \ISOMLY\SpatiePermissionsUI\Http\Controllers\RoleController::class)->except('show');

                Route::get('{resource}/{resourceId}/permissions', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelPermissionController::class, 'edit']);
                Route::patch('{resource}/{resourceId}/permissions', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelPermissionController::class, 'update'])->name('models.attach-permissions');

                Route::get('{resource}/{resourceId}/roles', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelRoleController::class, 'edit']);
                Route::patch('{resource}/{resourceId}/roles', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelRoleController::class, 'update'])->name('models.attach-roles');
            });
        };
    }
}
