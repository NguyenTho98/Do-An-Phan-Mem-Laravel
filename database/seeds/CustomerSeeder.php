<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Customer::class, 50)->create()->each(function ($customer) {
        //     $customer->recharges()->save(factory(App\Recharge::class)->make());
        //     $customer->orders()->save(factory(App\Order::class)->make());
        // });
        factory(App\Customer::class, 50)->create();
    }
}
