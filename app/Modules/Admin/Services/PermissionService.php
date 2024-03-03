<?php

namespace Modules\Admin\Services;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Permission;

class PermissionService {
    /**
     * update or create new permission
     * @param string $name
     * @return Permission
     */
    public static function save(array $params): Permission{
        $params['guard_name'] = 'web';
        $permission = Permission::updateOrCreate(['name'=>$params['name']],$params);
        return $permission;
    }

    public static function getList(): Collection{
        $permissions = Permission::orderBy('name')->get();
        return $permissions;
    }

	public static function getAllPermissionsNames(){
		$permissions = Permission::select('name')->orderBy('name')->get();
		return $permissions->pluck('name');
	}

    public static function getListGrouped(): Collection{
        $permissions = Permission::orderBy('name')->get();
        $permissions->each(function($permission){
            $permission->selected = false;
        });
        return $permissions->groupBy('group');
    }

    /**
     * Assign array of string roles to permission
     * @param Permission $permission
     * @param array $roles
     */
    public static function attachRole(Permission $permission,array $roles){
        $permission->syncRoles($roles);
    }

    /**
     * Unassign role to permission
     * @param Permission $permission
     * @param string $role
     */
    public static function detachRole(Permission $permission, string $role){
        $permission->removeRole($role);
    }

    /**
     * Get Users by permission parameter
     * @param string $permission
     * @return Collection
     */
    public static function getUsersByPermission(string $permission): Collection{
        $users = User::role($permission)->get();
        return $users;
    }

    public static function delete(string $namePermission): void{
        $permission = self::getByName($namePermission);
        if($permission) $permission->delete();
    }

    public static function getByName(string $namePermission): Model
    {
        $permission = Permission::where('name', $namePermission)->first();
        return $permission;
    }

    public static function getById(int $permissionId): Model
    {
        $permission = Permission::where('id', $permissionId)->first();
        return $permission;
    }

    public static function getGroups(): array{
        $permissions = config('admin.permissions');
        $groups = array_keys($permissions);
        sort($groups);
        return $groups;
    }

    public static function syncUsers(Permission $permission, array $users)
    {
        $usersIds = [];
        foreach ($users as $u) {
            $usersIds[] = $u['id'];
        }
        $permission->users()->detach();
        $permission->users()->sync($usersIds);
    }

}
