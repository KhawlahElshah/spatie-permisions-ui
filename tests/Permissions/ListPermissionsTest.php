<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Permission;

class ListPermissionsTest extends TestCase
{
    /**
     *@test
     */
    function it_lists_permissions()
    {
        $permission = Permission::create(['name' => 'create::permission']);

        $this->get('/permissions')
            ->assertOk()
            ->assertSee($permission->name);
    }
}
