<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateRoleTest extends TestCase
{
    /**
     *@test
     */
    function it_can_update_a_role()
    {
        $role = Role::create(['name' => 'manager']);
        $createPermission = Permission::create(['name' => 'create::role']);

        $role->givePermissionTo($createPermission);

        $listPermission = Permission::create(['name' => 'list::role']);

        $this->get("/roles/{$role->id}/edit")->assertOk();
        $this->patch("/roles/{$role->id}", [
            'name'        => 'admin',
            'permissions' => [$listPermission->id],
        ])
            ->assertRedirect('/roles');

        $this->assertDatabaseHas('roles', [
            'id'   => $role->id,
            'name' => 'admin',
        ]);

        $role = Role::first();

        $this->assertDatabaseCount('role_has_permissions', 1);
        $this->assertDatabaseHas('role_has_permissions', [
            'role_id'       => $role->id,
            'permission_id' => $listPermission->id,
        ]);
    }

    /**
     *@test
     */
    function role_name_is_required()
    {
        $role = Role::create(['name' => 'manager']);

        $this->get("/roles/{$role->id}/edit")->assertOk();
        $this->patch("/roles/{$role->id}", [
            'name' => '',
        ])
            ->assertSessionHasErrors(['name'])
            ->assertRedirect("/roles/{$role->id}/edit");
    }

    /**
     *@test
     */
    function role_attached_permissions_is_nullable()
    {
        $role = Role::create(['name' => 'manager']);

        $this->get("/roles/{$role->id}/edit")->assertOk();
        $this->patch("/roles/{$role->id}", [
            'permissions' => [],
        ])
            ->assertSessionDoesntHaveErrors(['permissions'])
            ->assertRedirect("/roles/{$role->id}/edit");
    }

    /**
     *@test
     */
    function permission_must_exists_if_it_was_attached_to_a_role()
    {
        $role = Role::create(['name' => 'manager']);

        $this->get("/roles/{$role->id}/edit")->assertOk();
        $this->patch("/roles/{$role->id}", [
            'permissions' => [9999],
        ])
            ->assertSessionHasErrors(['permissions.0'])
            ->assertRedirect("/roles/{$role->id}/edit");
    }
}
