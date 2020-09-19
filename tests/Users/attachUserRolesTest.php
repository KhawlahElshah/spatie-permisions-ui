<?php

namespace ISOMLY\SpatiePermissionsUI\Tests;

use Spatie\Permission\Models\Role;

class attachUserRolesTest extends TestCase
{
    /**
     *@test
     */
    function it_can_attach_roles_to_a_user()
    {
        $user = User::create(['name' => 'john Doe']);
        $role = Role::create(['name' => 'manager']);

        $this->get("/users/{$user->id}/roles")->assertOk();
        $this->patch("/users/{$user->id}/roles", [
            'roles' => [$role->id],
        ])
            ->assertRedirect("/users/{$user->id}/roles");

        $this->assertDatabaseHas('model_has_roles', [
            'model_id' => $user->id,
            'role_id'  => $role->id,
        ]);
    }

    /**
     *@test
     */
    function user_attached_roles_is_required()
    {
        $user = User::create(['name' => 'john Doe']);

        $this->get("/users/{$user->id}/roles")->assertOk();
        $this->patch("/users/{$user->id}/roles", [
            'roles' => [],
        ])
            ->assertSessionHasErrors(['roles'])
            ->assertRedirect("/users/{$user->id}/roles");
    }

    /**
     *@test
     */
    function role_must_exists_if_it_was_attached_to_a_user()
    {
        $user = User::create(['name' => 'john Doe']);

        $this->get("/users/{$user->id}/roles")->assertOk();
        $this->patch("/users/{$user->id}/roles", [
            'roles' => [9999],
        ])
            ->assertSessionHasErrors(['roles.0'])
            ->assertRedirect("/users/{$user->id}/roles");
    }
}
