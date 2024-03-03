<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Services\RoleService;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permsByRole = config('admin.rolePermissions');

        if ($this->isConfigured($permsByRole)) {
            RoleService::seedPermissionsByRole($permsByRole);
        }
    }

    private function isConfigured(?array $list): bool
    {
        return is_array($list) && count($list);
    }
}
