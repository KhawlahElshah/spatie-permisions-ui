<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Permission;

class UpdatePermissionTest extends TestCase
{
    /**
     *@test
     */
    function it_can_update_permission_name()
    {
        $permission = Permission::create(['name' => 'create::permission']);

        $this->get("/permissions/{$permission->id}/edit")->assertOk();
        $this->patch("/permissions/{$permission->id}", [
            'name' => 'update::post',
        ])
            ->assertRedirect('/permissions');

        $this->assertDatabaseHas('permissions', [
            'id'   => $permission->id,
            'name' => 'update::post',
        ]);
    }

    /**
     *@test
     */
    function permission_name_is_required()
    {
        $permission = Permission::create(['name' => 'create::permission']);

        $this->get("/permissions/{$permission->id}/edit")->assertOk();
        $this->patch("/permissions/{$permission->id}", [
            'name' => '',
        ])
            ->assertSessionHasErrors(['name'])
            ->assertRedirect("/permissions/{$permission->id}/edit");
    }
}
