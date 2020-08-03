<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [[
            'title' => 'Quản lý nhân viên',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'title' => 'Quản lý bán hàng',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'title' => 'Chăm sóc khách hàng',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]];
        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
