<?php

namespace ISOM\SpatiePermissionsUI;

use App\Models\User;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.roles-edit', [
            'roles' => $roles,
            'user'  => $user,
        ]);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'roles'   => 'required|array|min:1',
            'roles.*' => 'required|exists:roles,id',
        ]);

        $user->syncRoles($data['roles']);

        return redirect()->back();
    }
}
