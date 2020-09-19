<?php

namespace ISOMLY\SpatiePermissionsUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function edit($userId)
    {
        $userClass = config('auth.providers.users.model');
        $user = $userClass::find($userId);

        $permissions = Permission::all();

        return view('spatie-permissions-ui::users.permissions-edit', [
            'permissions' => $permissions,
            'user'        => $user,
        ]);
    }

    public function update($userId)
    {
        $userClass = config('auth.providers.users.model');
        $user = $userClass::find($userId);

        $data = request()->validate([
            'permissions'   => 'required|array|min:1',
            'permissions.*' => 'required|exists:permissions,id',
        ]);

        $user->syncPermissions($data['permissions']);

        return redirect()->back();
    }
}
