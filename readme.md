# Laravel Spatie Perissions UI

This package provides ui views for laravel permissions package made by Spatie

## Installation

### Install spatie permissions

follow the steps provides by the package on this [link](https://spatie.be/docs/laravel-permission/v3/installation-laravel), and make sure to always install latest version.

### Install permissions UI

- Install it via composer:

```bash
composer require isom/spatie-permissions-ui
```

- Publish views, translation using:

```bash
php artisan vendor:publish --provider="ISOM\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider" --tag="views"
```

- If you want to change translations you can optionally publish them using:

```bash
php artisan vendor:publish --provider="ISOM\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider" --tag="lang"
```

## Usage

You can find then **permissions, roles, users roles and permissions attachment** on `resources/views` and `resources/views/components` you can change easily change the layouts and elements classes to be fimilair with your project.

### Controllers

If you need to update the controllers, you can publish them to your project using:

```bash
php artisan vendor:publish --provider="ISOM\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider" --tag="controllers"
```
