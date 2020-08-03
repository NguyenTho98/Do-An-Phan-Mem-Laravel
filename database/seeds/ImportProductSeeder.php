<?php

use Illuminate\Database\Seeder;

class ImportProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ImportProduct::class, 20)->create();
    }
}
