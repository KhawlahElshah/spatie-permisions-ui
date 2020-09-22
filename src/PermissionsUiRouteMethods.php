<?php

namespace ISOMLY\SpatiePermissionsUI;

class PermissionsUiRouteMethods
{
    /**
     * Register the permissions ui routes.
     * 
     * @return callable
     */
    public function permissions()
    {
        return function ($options = []) {

            $this->group([], function () use ($options) {
                $this->resource('permissions', \ISOMLY\SpatiePermissionsUI\Http\Controllers\PermissionController::class)->except('show');
                $this->resource('roles', \ISOMLY\SpatiePermissionsUI\Http\Controllers\RoleController::class)->except('show');

                Route::get('users/{user}/permissions', [ISOMLY\SpatiePermissionsUI\Http\Controllers\UserPermissionController::class, 'edit']);
                Route::patch('users/{user}/permissions', [ISOMLY\SpatiePermissionsUI\Http\Controllers\UserPermissionController::class, 'update'])->name('users.attach-permissions');

                Route::get('users/{user}/roles', [ISOMLY\SpatiePermissionsUI\Http\Controllers\UserRoleController::class, 'edit']);
                Route::patch('users/{user}/roles', [ISOMLY\SpatiePermissionsUI\Http\Controllers\UserRoleController::class, 'update'])->name('users.attach-roles');
            });
        };
    }
}
