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

                Route::get('users/{user}/permissions', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\UserPermissionController::class, 'edit']);
                Route::patch('users/{user}/permissions', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\UserPermissionController::class, 'update'])->name('users.attach-permissions');

                Route::get('users/{user}/roles', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\UserRoleController::class, 'edit']);
                Route::patch('users/{user}/roles', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\UserRoleController::class, 'update'])->name('users.attach-roles');
            });
        };
    }
}
