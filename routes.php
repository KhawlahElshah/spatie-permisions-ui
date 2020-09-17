<?php

use Illuminate\Support\Facades\Route;
use ISOM\SpatiePermissionsUI\PermissionController;
use ISOM\SpatiePermissionsUI\RoleController;
use ISOM\SpatiePermissionsUI\UserPermissionController;
use ISOM\SpatiePermissionsUI\UserRoleController;

Route::group(['middleware' => ['web']], function () {

    Route::resource('permissions', PermissionController::class)->except('show');
    Route::resource('roles', RoleController::class)->except('show');

    Route::get('users/{user}/permissions', [UserPermissionController::class, 'edit']);
    Route::patch('users/{user}/permissions', [UserPermissionController::class, 'update'])->name('users.attach-permissions');

    Route::get('users/{user}/roles', [UserRoleController::class, 'edit']);
    Route::patch('users/{user}/roles', [UserRoleController::class, 'update'])->name('users.attach-roles');
});
