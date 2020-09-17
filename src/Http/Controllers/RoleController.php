<?php

namespace ISOM\SpatiePermissionsUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', ['permissions' => $permissions]);
    }

    public function store()
    {
        $data = request()->validate([
            'name'        => 'required|string|unique:roles,name,except,id',
            'permissions' => 'nullable|array',

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

        return view('roles.edit', ['permissions' => $permissions, 'role' => $role]);
    }

    public function update(Role $role)
    {
        $data = request()->validate([
            'name'        => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
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
