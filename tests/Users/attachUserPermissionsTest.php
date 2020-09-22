<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Permission;

class attachUserPermissionsTest extends TestCase
{
    /**
     *@test
     */
    function it_can_attach_permissions_to_a_user()
    {
        $user = User::create(['name' => 'john Doe']);
        $permission = Permission::create(['name' => 'create::permission']);

        $this->get("/users/{$user->id}/permissions")->assertOk();
        $this->patch("/users/{$user->id}/permissions", [
            'permissions' => [$permission->id],
        ])
            ->assertRedirect("/users/{$user->id}/permissions");

        $this->assertDatabaseHas('model_has_permissions', [
            'model_id'       => $user->id,
            'permission_id' => $permission->id,
        ]);
    }

    /**
     *@test
     */
    function it_can_attach_permissions_to_an_admin()
    {
        $admin = Admin::create(['name' => 'john Doe']);
        $permission = Permission::create(['name' => 'create::permission']);

        $this->get("/admins/{$admin->id}/permissions")->assertOk();
        $this->patch("/admins/{$admin->id}/permissions", [
            'permissions' => [$permission->id],
        ])
            ->assertRedirect("/admins/{$admin->id}/permissions");

        $this->assertDatabaseHas('model_has_permissions', [
            'model_id'       => $admin->id,
            'permission_id' => $permission->id,
        ]);
    }

    /**
     *@test
     */
    function user_attached_permissions_is_required()
    {
        $user = User::create(['name' => 'john Doe']);

        $this->get("/users/{$user->id}/permissions")->assertOk();
        $this->patch("/users/{$user->id}/permissions", [
            'permissions' => [],
        ])
            ->assertSessionHasErrors(['permissions'])
            ->assertRedirect("/users/{$user->id}/permissions");
    }

    /**
     *@test
     */
    function permission_must_exists_if_it_was_attached_to_a_user()
    {
        $user = User::create(['name' => 'john Doe']);

        $this->get("/users/{$user->id}/permissions")->assertOk();
        $this->patch("/users/{$user->id}/permissions", [
            'permissions' => [9999],
        ])
            ->assertSessionHasErrors(['permissions.0'])
            ->assertRedirect("/users/{$user->id}/permissions");
    }
}
