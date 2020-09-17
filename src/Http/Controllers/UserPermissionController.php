<?php

namespace ISOM\SpatiePermissionsUI\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function edit(User $user)
    {
        $permissions = Permission::all();

        return view('users.permissions-edit', [
            'permissions' => $permissions,
            'user'        => $user,
        ]);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'required|exists:permissions,id',
        ]);

        $user->syncPermissions($data['permissions']);

        return redirect()->back();
    }
}
