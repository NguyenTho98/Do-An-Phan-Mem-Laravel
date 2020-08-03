<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggerUpdateMoneyCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_update_money_customer_after_recharge AFTER INSERT ON `recharges` FOR EACH ROW
            BEGIN
                UPDATE customers SET money = money + new.total where id = new.customer_id;
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
        DB::unprepared('DROP TRIGGER `tr_update_money_customer_after_recharge`');
    }
}
