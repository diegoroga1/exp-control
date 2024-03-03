<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('admin.roles');

        foreach ($roles as $role => $description) {
            Role::updateOrCreate(['name' => $role], [
                'name' => $role,
                'guard_name' => 'web',
                'description' => $description,
            ]);
        }
    }
}
