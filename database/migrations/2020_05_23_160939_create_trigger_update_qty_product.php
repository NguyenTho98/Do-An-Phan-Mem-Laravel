<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggerUpdateQtyProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_update_qty_product AFTER INSERT ON `productkeys` FOR EACH ROW
            BEGIN
                UPDATE importproducts SET qty = qty + 1 where id = new.importproduct_id;
                UPDATE products SET qty = qty + 1 where id = (Select product_id from importproducts where id = new.importproduct_id);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_update_qty_product`');
    }
}
