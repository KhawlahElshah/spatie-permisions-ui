<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Permission;

class DeletePermissionTest extends TestCase
{
    /**
     *@test
     */
    function it_can_delete_permission()
    {
        $permission = Permission::create(['name' => 'create::permission']);

        $this->get("/permissions")->assertOk();
        $this->delete("/permissions/{$permission->id}")
            ->assertRedirect('/permissions');

        $this->assertDatabaseMissing('permissions', [
            'id'   => $permission->id,
            'name' => 'create::post',
        ]);
    }
}
