<?php

namespace Modules\Admin\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Role;

class RoleService {

    public static function getList(bool $withPermissions = false): Collection
    {
        $query = Role::orderBy('name');
        if ($withPermissions) $query->with('permissions');
        $roles = $query->get();
        return $roles;
    }

    public static function getRoleAllData(int $roleId): Model
    {
        $role = Role::where('id', $roleId)->with(['permissions'])->firstOrFail();
        $role->users = $role->users;
        return $role;
    }

    /**
     * Update or Create new Role
     * @param string $name
     * @return Role
     */
    public static function save(array $params): Role
    {
        $params['guard_name'] = 'web';
        $role = Role::updateOrCreate(['name' => $params['name']], $params);
        return $role;
    }

    /**
     * Assign a single permission to a role
     * @param Role $role
     * @param int|string $permission
     */
    public static function attachPermission(Role $role, int|string $permission)
    {
        $role->givePermissionTo($permission);
    }

    /**
     * Assign multiple permissions to a role
     * @param Role $role
     * @param array $permissions
     */
    public static function attachPermissions(Role $role, array $permissions): void
    {
        $role->givePermissionTo($permissions);
    }

    /**
     * Seed name permissions grouped by role name
     * @param array $permissions
     */
    public static function seedPermissionsByRole(array $permissions): void
    {
        $rolesList = array_keys($permissions);

        $roles = Role::whereIn('name', $rolesList)->get()->keyBy('name');

        foreach ($permissions as $roleName => $permissionsList) {
            $role = $roles[$roleName];

            static::attachPermissions($role, $permissionsList);
        }
    }

    /**
     * Assign array of string permissions to role
     * @param Role $role
     * @param array $permission
     */
    public static function syncPermission(Role $role, array $permission)
    {
        $ids = array_column($permission,'id');
        $role->syncPermissions($ids);
    }

    /**
     * Unasign permissions to role
     * @param Role $role
     * @param int|string $permissions
     */
    public static function detachPermission(Role $role, int|string $permissions)
    {
        $role->revokePermissionTo($permissions);
    }

    /**
     * Get users by role parameter
     * @param int|string $role
     * @return Collection
     */
    public static function getUsersByRole(int|string $role): Collection
    {
        $users = User::role($role)->get();
        return $users;
    }

    /**
     * Get role with permissions by role name
     * @param string $role
     * @return Model
     */
    public static function getByName(string $role): Model
    {
        $role = Role::with('permissions')->where('name', $role)->first();
        return $role;
    }

    /**
     * Get role with permissions by role id
     * @param int $roleId
     * @return Role
     */
    public static function getById(int $roleId): Role
    {
        $role = Role::find($roleId);
        return $role;
    }

    /**
     * Delete role by name
     * @param string $role
     */
    public static function delete(string $role): void
    {
        $role = self::getByName($role);
        if ($role) $role->delete();
    }

    public static function hasPermission(Role $role, string $permissionName): bool
    {
        return $role->hasPermissionTo($permissionName);
    }

    public static function syncUsers(Role $role, array $users)
    {
        $usersIds = [];
        foreach ($users as $u) {
            $usersIds[] = $u['id'];
        }
        $role->users()->detach();
        $role->users()->sync($usersIds);
    }
}
