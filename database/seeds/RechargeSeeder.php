<?php

use Illuminate\Database\Seeder;

class RechargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Recharge::class, 50)->create();
    }
}
