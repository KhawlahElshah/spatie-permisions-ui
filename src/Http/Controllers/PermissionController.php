<?php

namespace ISOM\SpatiePermissionsUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('spatie-permissions-ui::permissions.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|unique:permissions,name,except,id',
        ]);

        Permission::create($data);

        return redirect(route('permissions.index'));
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission)
    {
        $data = request()->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($data);

        return redirect(route('permissions.index'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect(route('permissions.index'));
    }
}
