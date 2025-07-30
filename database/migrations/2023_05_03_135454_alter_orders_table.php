<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {    
            $table->float('tax',8,2)->nullable();
            $table->string('prices_include_tax')->default('1')->comment("1:false,2:true");
            $table->float('cart_tax',8,2)->nullable();
            $table->float('shipping_total',8,2)->nullable();
            $table->float('shipping_tax',8,2)->nullable();
            $table->float('discount_total',8,2)->nullable();
            $table->float('discount_tax',8,2)->nullable();
            $table->float('total_tax',8,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_method_title')->nullable();
            $table->string('customer_ip_address')->nullable();
            $table->string('customer_user_agent')->nullable();
            $table->text('customer_note')->nullable();
            $table->string('created_via')->nullable();
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
