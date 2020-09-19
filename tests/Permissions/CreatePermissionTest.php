<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

class CreatePermissionTest extends TestCase
{
    /**
     *@test
     */
    function it_can_create_new_permission()
    {
        $this->get('/permissions/create')->assertOk();
        $this->post('/permissions', [
            'name' => 'create::post',
        ])
            ->assertRedirect('/permissions');

        $this->assertDatabaseHas('permissions', [
            'name' => 'create::post',
        ]);
    }

    /**
     *@test
     */
    function permission_name_is_required()
    {
        $this->get('/permissions/create')->assertOk();
        $this->post('/permissions', [
            'name' => '',
        ])
            ->assertSessionHasErrors(['name'])
            ->assertRedirect('/permissions/create');
    }
}
