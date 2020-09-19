<?php

namespace ISOMLY\SpatiePermissionsUI\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function edit($userId)
    {
        $userClass = config('auth.providers.users.model');
        $user = $userClass::find($userId);

        $roles = Role::all();

        return view('spatie-permissions-ui::users.roles-edit', [
            'roles' => $roles,
            'user'  => $user,
        ]);
    }

    public function update($userId)
    {
        $userClass = config('auth.providers.users.model');
        $user = $userClass::find($userId);

        $data = request()->validate([
            'roles'   => 'required|array|min:1',
            'roles.*' => 'required|exists:roles,id',
        ]);

        $user->syncRoles($data['roles']);

        return redirect()->back();
    }
}
