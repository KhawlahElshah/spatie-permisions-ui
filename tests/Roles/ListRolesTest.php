<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Role;

class ListRolesTest extends TestCase
{
    /**
     *@test
     */
    function it_lists_roles()
    {
        $role = Role::create(['name' => 'manager']);

        $this->get('/roles')
            ->assertOk()
            ->assertSee($role->name);
    }
}
