<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerUpdateQtyProductAfterPay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_update_qty_product_after_pay AFTER INSERT ON `orderdetails` FOR EACH ROW
            BEGIN
                UPDATE products SET qty = qty - 1 where id IN
                        ( select products.id from orderdetails
                                left join productkeys on orderdetails.productkey_id = productkeys.id
                                left join importproducts on productkeys.importproduct_id = importproducts.id
                                left join products on importproducts.product_id = products.id
                                where orderdetails.id = new.id );
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
        DB::unprepared('DROP TRIGGER `trigger_update_qty_product_after_pay`');
    }
}
