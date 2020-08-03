<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [[
            'title' => 'Thêm nhân viên',
            'name' => 'create-user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'title' => 'Xem danh sách nhân viên',
            'name' => 'view-user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'title' => 'Sửa thông tin nhân viên',
            'name' => 'update-user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'title' => 'Xóa nhân viên',
            'name' => 'delete-user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'title' => 'Xóa sản phẩm',
            'name' => 'delete-product',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]];
        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }
    }
}
