<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRoleTest extends TestCase
{
    /**
     *@test
     */
    function it_can_create_new_role()
    {
        $permission = Permission::create(['name' => 'create::permission']);

        $this->get('/roles/create')->assertOk();
        $this->post('/roles', [
            'name'        => 'maanger',
            'permissions' => [$permission->id],
        ])
            ->assertRedirect('/roles');

        $this->assertDatabaseHas('roles', [
            'name' => 'maanger',
        ]);

        $role = Role::first();

        $this->assertDatabaseHas('role_has_permissions', [
            'role_id'       => $role->id,
            'permission_id' => $permission->id,
        ]);
    }

    /**
     *@test
     */
    function role_name_is_required()
    {
        $this->get('/roles/create')->assertOk();
        $this->post('/roles', [
            'name' => '',
        ])
            ->assertSessionHasErrors(['name'])
            ->assertRedirect('/roles/create');
    }

    /**
     *@test
     */
    function role_attached_permissions_is_nullable()
    {
        $this->get('/roles/create')->assertOk();
        $this->post('/roles', [
            'permissions' => [],
        ])
            ->assertSessionDoesntHaveErrors(['permissions'])
            ->assertRedirect('/roles/create');
    }

    /**
     *@test
     */
    function permission_must_exists_if_it_was_attached_to_a_role()
    {
        $this->get('/roles/create')->assertOk();
        $this->post('/roles', [
            'permissions' => [9999],
        ])
            ->assertSessionHasErrors(['permissions.0'])
            ->assertRedirect('/roles/create');
    }
}
