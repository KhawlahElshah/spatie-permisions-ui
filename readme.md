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
        Route::resource('permissions', \ISOMLY\SpatiePermissionsUI\Http\Controllers\PermissionController::class)->except('show');
        Route::resource('roles', \ISOMLY\SpatiePermissionsUI\Http\Controllers\RoleController::class)->except('show');

        Route::get('{resource}/{resourceId}/permissions', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelPermissionController::class, 'edit']);
        Route::patch('{resource}/{resourceId}/permissions', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelPermissionController::class, 'update'])->name('models.attach-permissions');

        Route::get('{resource}/{resourceId}/roles', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelRoleController::class, 'edit']);
        Route::patch('{resource}/{resourceId}/roles', [\ISOMLY\SpatiePermissionsUI\Http\Controllers\ModelRoleController::class, 'update'])->name('models.attach-roles');
```

If you need to authorize routes access you can publish the package routes group using

```bash
php artisan permissions-ui:publish-routes
```

which will add the following to your `routes/web.php`

```bash
\ISOMLY\SpatiePermissionsUI\Facades\PermissionsUI::routes();
```

so now you can add custom middleware to these routes, example:

```
Route::group(['middleware' => 'auth'], function () {
    PermissionsUI::routes();
});
```

### Multi models permissions ui

if you need to generate the permissions and roles attachment to a model ui for multiple models you need first to publish the package config file

```bash
php artisan vendor:publish --provider="ISOMLY\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider" --tag="config"
```

a config file will be generated on `config/permissionsui.php` with these default config options

```php
return [
    'resources' => [
        'users' => App\Models\User::class,
    ],
];
```

you can add another `resource` indicating the resource name with will be used on the routes and the model it refers to, like following:

```php
return [
    'resources' => [
        'users' => App\Models\User::class,
        'admins' => App\Models\Admin::class,
    ],
];
```

which will enable you to call routes like following

```
[GET] users/1/roles
[PATCH] users/1/roles
[GET] users/1/permissions
[PATCH] users/1/permissions

[GET] admins/1/roles
[PATCH] admins/1/roles
[GET] admins/1/permissions
[PATCH] admins/1/permissions

```

## Todos:

- [ ] Set the views classes using css framework as an option
