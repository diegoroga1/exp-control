<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\RoleSaveRequest;
use Modules\Admin\Http\Requests\RoleSyncPermissionsRequest;
use Modules\Admin\Http\Requests\RoleSyncUsersRequest;
use Modules\Admin\Services\RoleService;
use Modules\Admin\Transformers\RoleResource;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.roles.list')->only(['index', 'getRoles']);

        $this->middleware('permission:admin.roles.show')->only(['show']);

        $this->middleware('permission:admin.roles.create')->only(['save']);

        $this->middleware('permission:admin.roles.update')->only(['save']);

        $this->middleware('permission:admin.roles.delete')->only(['delete']);
    }

    public function index()
    {
        return view('admin::roles.index');
    }

    public function show($roleId)
    {
        $role = RoleService::getById($roleId);

        return view('admin::roles.show', [
            'role' => $role,
            'roleId' => $roleId,
        ]);
    }

    public function getRoleData($roleId)
    {
        $role = RoleService::getRoleAllData($roleId);

        $data = [
            'item' => new RoleResource($role),
        ];

        return response()->json($data);
    }

    public function getRoles()
    {
        $roles = RoleService::getList(true);

        return RoleResource::collection($roles);
    }

    public function save(RoleSaveRequest $request)
    {
        $role = RoleService::save($request->all());

        return new RoleResource($role);
    }

    public function delete(Role $role)
    {
        RoleService::delete($role->name);

        return $this->getRoles();
    }

    public function syncPermissions(RoleSyncPermissionsRequest $request, Role $role)
    {
        $permissions = $request->permissions;

        RoleService::syncPermission($role,$permissions);

        return $this->getRoleData($role->id);
    }

    public function syncUsers(RoleSyncUsersRequest $request, Role $role)
    {
        $users = $request->users;

        RoleService::syncUsers($role,$users);

        return $this->getRoleData($role->id);
    }
}
