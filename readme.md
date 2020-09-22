# Laravel Spatie Perissions UI

This package provides ui views for laravel permissions package made by Spatie

## Installation

### Install spatie permissions

Install and configure spatie permissions package [link](https://spatie.be/docs/laravel-permission/v3/installation-laravel), and make sure to always install latest version.

### Install permissions UI

- Install it via composer:

```bash
composer require isomly/spatie-permissions-ui
```

- Publish views, translation using:

```bash
php artisan vendor:publish --provider="ISOMLY\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider" --tag="views"
```

- If you want to change translations you can optionally publish them using:

```bash
php artisan vendor:publish --provider="ISOMLY\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider" --tag="lang"
```

## Usage

You can find the **permissions, roles, users roles and permissions attachment** views and components `resources/views/vendor/spatie-permissions-ui` you can easily change the layouts and elements classes to extend your project design.

### Controllers

If you need to update the controllers, you can publish them to your project using:

```bash
php artisan vendor:publish --provider="ISOMLY\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider" --tag="controllers"
```

### Routes

Automatically the package routes are registered and you can use them

```php
    $this->resource('permissions', \ISOMLY\SpatiePermissionsUI\Http\Controllers\PermissionController::class)->except('show');
    $this->resource('roles', \ISOMLY\SpatiePermissionsUI\Http\Controllers\RoleController::class)->except('show');

    Route::get('users/{user}/permissions', [ISOMLY\SpatiePermissionsUI\Http\Controllers\UserPermissionController::class, 'edit']);
    Route::patch('users/{user}/permissions', [ISOMLY\SpatiePermissionsUI\Http\Controllers\UserPermissionController::class, 'update'])->name('users.attach-permissions');

    Route::get('users/{user}/roles', [ISOMLY\SpatiePermissionsUI\Http\Controllers\UserRoleController::class, 'edit']);
    Route::patch('users/{user}/roles', [ISOMLY\SpatiePermissionsUI\Http\Controllers\UserRoleController::class, 'update'])->name('users.attach-roles');
```

If you need to authorize routes access you can publish the package routes group using

```bash
php artisan permissions-ui:publish-routes
```

which will add the following to your `routes/web.php`

```
\ISOMLY\SpatiePermissionsUI\Facades\PermissionsUI::routes();
```

so now you can add custom middleware to these routes, example:

```
Route::group(['middleware' => 'auth'], function () {
    PermissionsUI::routes();
});
```

## Todos:

- [ ] Set the views classes using css framework as an option
- [ ] Set the permissions and attachments controllers for multiple models not only user
