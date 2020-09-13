<?php

namespace ISOM\SpatiePermissionsUI;

use App\Models\User;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('users.create', [
            'permissions' => $permissions,
            'roles'       => $roles,
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'name'        => 'required|string',
            'email'       => 'required|string|unique:users,email,except,id',
            'role'        => 'required|exists:roles,id',
            'permissions' => 'nullable|array',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt(random_int(00000, 99999)),
        ]);

        $user->assignRole($data['role']);

        if (array_key_exists('permissions', $data) && $data['permissions']) {
            $user->givePermissionTo($data['permissions']);
        }

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('users.edit', [
            'permissions' => $permissions,
            'roles'       => $roles,
            'user'        => $user,
        ]);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name'        => 'required|string',
            'email'       => 'required|string|unique:users,email,' . $user->id,
            'role'        => 'required|exists:roles,id',
            'permissions' => 'nullable|array',
        ]);

        $user->update([
            'name'     => $data['name'],
            'email'    => $data['email'],
        ]);

        $user->syncRoles($data['role']);

        if (array_key_exists('permissions', $data) && $data['permissions']) {
            $user->syncPermissions($data['permissions']);
        }

        return redirect(route('users.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('users.index'));
    }
}
