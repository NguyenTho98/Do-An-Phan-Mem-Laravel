<?php

use Illuminate\Database\Seeder;

class ProductKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProductKey::class, 100)->create();
    }
}
