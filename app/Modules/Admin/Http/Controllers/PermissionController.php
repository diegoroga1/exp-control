<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Http\Requests\PermissionSaveRequest;
use Modules\Admin\Http\Requests\PermissionSyncUsersRequest;
use Modules\Admin\Services\PermissionService;
use Modules\Admin\Transformers\PermissionResource;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.perms.list')->only(['index', 'listData', 'listGroups']);

        $this->middleware('permission:admin.perms.show')->only(['show']);

        $this->middleware('permission:admin.perms.create')->only(['save']);

        $this->middleware('permission:admin.perms.update')->only(['save']);

        $this->middleware('permission:admin.perms.delete')->only(['delete']);
    }

    public function index()
    {
        return view('admin::permissions.index');
    }

    public function show($permissionId)
    {
        $permission = PermissionService::getById($permissionId);

        return view('admin::permissions.show', [
            'permission' => $permission,
            'permissionId' => $permissionId,
        ]);
    }

    public function getPermissionData($permissionId)
    {
        $permission = PermissionService::getById($permissionId);

        return new PermissionResource($permission);
    }

    public function listData()
    {
        $permissions = PermissionService::getList();

        return response()->json($permissions);
    }

    public function listGroups()
    {
        $permissions = PermissionService::getListGrouped();

        return response()->json($permissions);
    }

    public function delete(Permission $permission)
    {
        PermissionService::delete($permission->name);

        return $this->listData();
    }

    public function getGroups()
    {
        $groups = PermissionService::getGroups();

        return response()->json($groups);
    }

    public function save(PermissionSaveRequest $request)
    {
        $permission = PermissionService::save($request->all());

        return new PermissionResource($permission);
    }

    public function syncUsers(PermissionSyncUsersRequest $request, Permission $permission)
    {
        $users = $request->users;

        PermissionService::syncUsers($permission,$users);

        return $this->getPermissionData($permission->id);
    }
}
