<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [[
            'role_id' => 1,
            'permission_id' => 1
        ],
        [
            'role_id' => 1,
            'permission_id' => 2
        ],
        [
            'role_id' => 1,
            'permission_id' => 3
        ],
        [
            'role_id' => 1,
            'permission_id' => 4
        ],
        [
            'role_id' => 2,
            'permission_id' => 5
        ]];
        foreach ($permissions as $permission) {
            DB::table('role_permission')->insert($permission);
        }
    }
}
