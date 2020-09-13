<?php

use Illuminate\Support\Facades\Route;
use ISOM\SpatiePermissionsUI\PermissionController;
use ISOM\SpatiePermissionsUI\RoleController;
use ISOM\SpatiePermissionsUI\UserController;

Route::group(['middleware' => ['web']], function () {

    Route::resource('permissions', PermissionController::class)->except('show');
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('users', UserController::class)->except('show');
});
