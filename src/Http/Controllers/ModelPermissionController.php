<?php

namespace ISOMLY\SpatiePermissionsUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

class ModelPermissionController extends Controller
{
    public function edit($resource, $resourceId)
    {
        $modelClass = getModelForResource($resource);
        $model = $modelClass::findOrFail($resourceId);

        $permissions = Permission::all();

        return view('spatie-permissions-ui::users.permissions-edit', [
            'permissions' => $permissions,
            'model'       => $model,
        ]);
    }

    public function update($resource, $resourceId)
    {
        $modelClass = getModelForResource($resource);
        $model = $modelClass::findOrFail($resourceId);

        $data = request()->validate([
            'permissions'   => 'required|array|min:1',
            'permissions.*' => 'required|exists:permissions,id',
        ]);

        $model->syncPermissions($data['permissions']);

        return redirect()->back();
    }
}
