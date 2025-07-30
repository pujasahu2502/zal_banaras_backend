<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();            
            $table->float('amount',8,2);
            $table->string('name_on_card')->nullable();            
            $table->string('response_code')->nullable();            
            $table->string('transaction_id')->nullable();            
            $table->string('auth_id')->nullable();            
            $table->string('message_code')->nullable();
            $table->enum('order_status',['1','2','3'])->default('1')->comment("1:Processing,2:On hold,3:Completed");
            $table->enum('payment_status',['1','2'])->default('1')->comment("1:Pending,2:Completed");
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('shipping_address_id')->nullable();
            $table->unsignedBigInteger('billing_address_id')->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("shipping_address_id")->references("id")->on("addresses")->onDelete("cascade");
            $table->foreign("billing_address_id")->references("id")->on("addresses")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
