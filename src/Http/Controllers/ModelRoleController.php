<?php

namespace ISOMLY\SpatiePermissionsUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

class ModelRoleController extends Controller
{
    public function edit($resource, $resourceId)
    {
        $modelClass = getModelForResource($resource);
        $model = $modelClass::findOrFail($resourceId);

        $roles = Role::all();

        return view('spatie-permissions-ui::users.roles-edit', [
            'roles' => $roles,
            'model' => $model,
        ]);
    }

    public function update($resource, $resourceId)
    {
        $modelClass = getModelForResource($resource);
        $model = $modelClass::findOrFail($resourceId);

        $data = request()->validate([
            'roles'   => 'required|array|min:1',
            'roles.*' => 'required|exists:roles,id',
        ]);

        $model->syncRoles($data['roles']);

        return redirect()->back();
    }
}
