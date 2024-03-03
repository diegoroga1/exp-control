<?php

namespace Modules\Admin\Tests\Unit;

use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Entities\Role;
use Modules\Admin\Services\PermissionService;
use Modules\Admin\Services\RoleService;
use Modules\Admin\Services\UserService;
use Modules\Admin\Tests\ModuleTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolesTest extends ModuleTestCase
{
    protected static $data = ["name" => 'prueba'];

    /**
     * @test
     */
    public function getConfigPermission(){
        $moduleConfig = config('permission');
        $this->assertIsArray($moduleConfig);
    }
    /**
     * @test
     */
    public function list(){
        $list = RoleService::getList();
        $this->assertTrue($list instanceof Collection);
        $this->assertGreaterThan(0,$list->count());
    }

    /**
     * @test
     */
    public function show(){
        $role = RoleService::save(['name'=>'show_test']);
        $this->setUser();
        $user = $this->user;
        UserService::setRole($user,$role->id);
        $this->assertTrue($user->hasRole($role->id));
        $item = RoleService::getRoleAllData($role->id);
        RoleService::delete($role->name);
    }


    /**
     * @test
     *
     */
    public function save(){
        $this->setUser();
        $this->assertDatabaseMissing('roles',self::$data);
        $item = RoleService::save(self::$data);
        $this->assertTrue($item instanceof Role);
        $this->assertDatabaseHas('roles',self::$data);
    }


    /**
     * @test
     */
    public function remove(){
        $this->assertDatabaseHas('roles',self::$data);
        $item = Role::where('name',self::$data['name'])->firstOrFail();
        RoleService::delete($item->name);
        $this->assertDatabaseMissing('roles',self::$data);
    }

    /**
     * @test
     */
    public function syncPermissions(){
        $role = Role::inRandomOrder()->first();
        do{
            $permission = Permission::inRandomOrder()->first();
        }while(RoleService::hasPermission($role,$permission->name));
        $this->assertDatabaseMissing('role_has_permissions',['role_id' => $role->id,'permission_id' => $permission->id]);
        RoleService::attachPermission($role,$permission->id);
        $this->assertDatabaseHas('role_has_permissions',['role_id' => $role->id,'permission_id' => $permission->id]);
        RoleService::detachPermission($role,$permission->id);
        $this->assertDatabaseMissing('role_has_permissions',['role_id' => $role->id,'permission_id' => $permission->id]);
    }
}
