<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = config('admin.permissions');

        foreach ($permissions as $permission => $description) {
            Permission::updateOrCreate(['name' => $permission], [
                'guard_name' => 'web',
                'group' => 'admin',
                'name' => $permission,
                'description' => $description,
            ]);
        }
    }
}
