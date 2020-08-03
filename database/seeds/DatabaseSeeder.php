<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CouponSeeder::class,
            CategorySeeder::class,
            PublisherSeeder::class,
            CustomerSeeder::class,
            RechargeSeeder::class,
            ProductSeeder::class,
            ImportProductSeeder::class,
            ProductKeySeeder::class,
            OrderSeeder::class,
            CommentSeeder::class,
            FeedbackSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
