<?php

namespace ISOM\SpatiePermissionsUI\Tests;

class PermissionTest extends TestCase
{
    /**
     *@test
     */
    function it_can_create_new_permission()
    {
        $this->withoutExceptionHandling();

        $this->get('/permissions/create')->assertOk();
        $this->post('/permissions', [
            'name' => 'create::post',
        ]);

        $this->assertDatabaseCount(1, 'permissions');
    }
}
