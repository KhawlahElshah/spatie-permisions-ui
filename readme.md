# Laravel Spatie Perissions UI

This package provides ui views for laravel permissions package made by Spatie

## Installation

### Install spatie permissions

follow the steps provides by the package on this [link](https://spatie.be/docs/laravel-permission/v3/installation-laravel), and make sure to always install latest version.

## Install permissions UI

- Install it via composer:

`composer require isom/spatie-permissions-ui`

- Publish the controllers, views, translation using:

`php artisan vendor:publish --provider="ISOM\SpatiePermissionsUI\SpatiePermissionsUiServiceProvider"`

- Create views and include componenets

create the following views and include the follwing components into them on

1- `resources/views/permissions`

- `resources/views/permissions/index.blade.php` include

```html
<x-spatie-permissions-ui::permissions.table
  :permissions="$permissions"
></x-spatie-permissions-ui::permissions.table>
```

- `resources/views/permissions/create.blade.php` include

```html
<x-spatie-permissions-ui::permissions.create-form></x-spatie-permissions-ui::permissions.create-form>
```

- `resources/views/permissions/edit.blade.php` include

```html
<x-spatie-permissions-ui::permissions.edit-form :permission="$permission">
</x-spatie-permissions-ui::permissions.edit-form>
```

2- `resources/views/roles`

- `resources/views/roles/index.blade.php` include

```html
<x-spatie-permissions-ui::roles.table
  :roles="$roles"
></x-spatie-permissions-ui::roles.table>
```

- `resources/views/roles/create.blade.php` include

```html
<x-spatie-permissions-ui::roles.create-form :permissions="$permissions">
</x-spatie-permissions-ui::roles.create-form>
```

- `resources/views/roles/edit.blade.php` include

```html
<x-spatie-permissions-ui::roles.edit-form
  :role="$role"
  :permissions="$permissions"
>
</x-spatie-permissions-ui::roles.edit-form>
```

3- `resources/views/users`

- `resources/views/users/index.blade.php` include

```html
<x-spatie-permissions-ui::users.table
  :users="$users"
></x-spatie-permissions-ui::users.table>
```

- `resources/views/users/create.blade.php` include

```html
<x-spatie-permissions-ui::users.create-form
  :roles="$roles"
  :permissions="$permissions"
>
</x-spatie-permissions-ui::users.create-form>
```

- `resources/views/users/edit.blade.php` include

```html
<x-spatie-permissions-ui::users.edit-form
  :user="$user"
  :roles="$roles"
  :permissions="$permissions"
>
</x-spatie-permissions-ui::users.edit-form>
```
