<?php

use Illuminate\Support\Facades\Route;
use ISOMLY\SpatiePermissionsUI\Http\Controllers\PermissionController;
use ISOMLY\SpatiePermissionsUI\Http\Controllers\RoleController;
use ISOMLY\SpatiePermissionsUI\Http\Controllers\UserPermissionController;
use ISOMLY\SpatiePermissionsUI\Http\Controllers\UserRoleController;

Route::group(['middleware' => ['web']], function () {

    Route::resource('permissions', PermissionController::class)->except('show');
    Route::resource('roles', RoleController::class)->except('show');

    Route::get('users/{user}/permissions', [UserPermissionController::class, 'edit']);
    Route::patch('users/{user}/permissions', [UserPermissionController::class, 'update'])->name('users.attach-permissions');

    Route::get('users/{user}/roles', [UserRoleController::class, 'edit']);
    Route::patch('users/{user}/roles', [UserRoleController::class, 'update'])->name('users.attach-roles');
});
