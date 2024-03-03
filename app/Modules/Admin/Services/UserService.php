<?php

namespace Modules\Admin\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService {

    /**
     * List Users
     * @return Collection
     */
    public static function getUsers(): Collection
    {
        $query = User::query();
        $result = $query->get();
        return $result;
    }

	/**
	 * List Users By Installation ID
	 */
	public static function getUsersByInstallation(int $installationId)
	{
		$query =DB::table('users')
			->leftJoin('user_installations','user_installations.user_id','=','users.id')
			->where('user_installations.installation_id',$installationId)->select('users.id','users.name as text');

		$result = $query->get()->toArray();
		return $result;
	}

    /**
     * Show one user
     * @param int $userId
     * @return User
     * @throws \Exception
     */
    public static function getUserDetails(int $userId): User
    {
        $user = User::where('id', $userId)->first();
        if (!$user) throw new \Exception(__('admin::users.user_not_found', ['user' => $userId]));
        $user->permissions = $user->permissions;
        return $user;
    }

    /**
     * Set or unset password with hash for save
     * @param Request $request
     * @return array
     */
    public static function parseSaveData(Request $request): array
    {
        $req = $request->all();
        if (!$req['password']) {
            unset($req['password']);
        } else {
            $req['password'] = Hash::make($req['password']);
        }
        return $req;
    }

    public static function saveUser(Request $request)
    {
        $req = self::parseSaveData($request);
        $user = User::updateOrCreate(['id' => $req['id']], $req);
        //save permissions
        self::syncPermissions($user, $request->permissions);
        self::syncRoles($user, $request->roles);

		//save installations
		if(isset($request->installations)) self::syncInstallations($user, $request->installations);


		return $user;
    }

	public static function syncInstallations(User $user, array $installations){
		$arrayIds = array_column($installations,'id');
		$user->installations()->sync($arrayIds);
	}

    /**
     * Delete user or fail if is teams owner
     * @param User $user
     */
    public static function deleteUser(User $user): void
    {
        DB::transaction(function () use ($user) {
            $user->delete();
        });
    }

    public static function setRole(User $user, int|string $roleName): User
    {
        $user->syncRoles($roleName);
        return $user;
    }

    public static function setPermission(User $user, int|string $permission): User
    {
        $user->givePermissionTo($permission);
        return $user;
    }

    public static function syncPermissions(User $user, array $permission): User
    {
        $ids = array_column($permission,'id');
        $user->syncPermissions($ids);
        return $user;
    }

    public static function syncRoles(User $user, array $roles): User
    {
        $ids=array_column($roles,'id');
        $user->syncRoles($ids);
        return $user;
    }

	public static function getAllPermissions(User $user):\Illuminate\Support\Collection{
		if($user->isAdmin()){
			return PermissionService::getAllPermissionsNames();
		}
		$permissions = $user->getAllPermissions();
		return $permissions->pluck('name');
	}

}
