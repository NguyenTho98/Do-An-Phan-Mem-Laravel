<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerUpdateQtyCouponAfterPay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_update_qty_coupon_after_pay AFTER INSERT ON `orderdetails` FOR EACH ROW
            BEGIN
                UPDATE coupon SET qty = qty - 1 where id IN
                        ( select coupon.id from orderdetails
                                left join orders on orderdetails.order_id = orders.id
                                left join coupon on orders.coupon_id = coupon.id
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
        DB::unprepared('DROP TRIGGER `trigger_update_qty_coupon_after_pay`');
    }
}
