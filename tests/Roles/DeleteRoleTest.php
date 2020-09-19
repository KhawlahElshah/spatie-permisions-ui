<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Role;

class DeleteRoleTest extends TestCase
{
    /**
     *@test
     */
    function it_can_delete_role()
    {
        $role = Role::create(['name' => 'manager']);

        $this->get("/roles")->assertOk();
        $this->delete("/roles/{$role->id}")
            ->assertRedirect('/roles');

        $this->assertDatabaseMissing('roles', [
            'id'   => $role->id,
            'name' => 'manager',
        ]);
    }
}
