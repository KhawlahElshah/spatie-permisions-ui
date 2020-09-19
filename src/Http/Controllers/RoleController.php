<?php

namespace ISOMLY\SpatiePermissionsUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('spatie-permissions-ui::roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('spatie-permissions-ui::roles.create', ['permissions' => $permissions]);
    }

    public function store()
    {
        $data = request()->validate([
            'name'          => 'required|string|unique:roles,name,except,id',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'nullable|exists:permissions,id',
        ]);

        $role = Role::create($data);

        if (array_key_exists('permissions', $data) && $data['permissions']) {
            $role->givePermissionTo($data['permissions']);
        }

        return redirect(route('roles.index'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('spatie-permissions-ui::roles.edit', ['permissions' => $permissions, 'role' => $role]);
    }

    public function update(Role $role)
    {
        $data = request()->validate([
            'name'          => 'required|string|unique:roles,name,' . $role->id,
            'permissions'   => 'nullable|array',
            'permissions.*' => 'nullable|exists:permissions,id',
        ]);

        $role->update($data);

        if (array_key_exists('permissions', $data) && $data['permissions']) {
            $role->syncPermissions($data['permissions']);
        }

        return redirect(route('roles.index'));
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect(route('roles.index'));
    }
}
