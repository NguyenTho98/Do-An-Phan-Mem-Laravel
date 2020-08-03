<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [[
            'name'=> "vinh1",
            'value' => 10000,
            'qty' => 20,
            'start' => Carbon::now(),
            'end' => date('2020/12/01'),
            'coupon_price' => 100000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name'=> "vinh2",
            'value' => 10,
            'qty' => 20,
            'start' => Carbon::now(),
            'end' => date('2020/12/01'),
            'coupon_price' => 100000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name'=> "vinh3",
            'value' => 10000,
            'qty' => 20,
            'start' => Carbon::now(),
            'end' => date('2020/12/01'),
            'coupon_price' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name'=> "vinh4",
            'value' => 10000,
            'coupon_price' => 0,
            'qty' => 20,
            'start' => date('2020/07/01'),
            'end' => date('2020/07/05'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name'=> "vinh5",
            'value' => 20000,
            'qty' => 20,
            'start' => Carbon::now(),
            'end' => date('2020/10/01'),
            'coupon_price' => 300000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]];
        foreach ($coupons as $coupon) {
            DB::table('coupon')->insert($coupon);
        }
    }
}
