<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOrderStatusEnumToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {    
            DB::statement("ALTER TABLE orders MODIFY order_status 
            enum('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11') NOT NULL DEFAULT 1 
            COMMENT '1:Processing,2:On hold,3:Completed, 4: Refunded, 5:any,6:trash,7:auto-draft, 8: pending, 9:cancelled,10:failed,11:checkout-draft';");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
