<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCoulmnsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {    
            if (Schema::hasColumn('orders', 'shipping_tax'))
            {
                $table->dropColumn('shipping_tax');
            }
            if (Schema::hasColumn('orders', 'discount_tax'))
            {
                $table->dropColumn('discount_tax');
            }
            if (Schema::hasColumn('orders', 'tax'))
            {
                $table->dropColumn('tax');
            }
            if (Schema::hasColumn('orders', 'cart_tax'))
            {
                $table->dropColumn('cart_tax');
            }
            $table->longtext('customer_user_agent')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
