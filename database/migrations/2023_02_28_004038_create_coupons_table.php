<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('type',['1','2','3'])->comment('1:Flat Rate, 2:Fixed Price , 3:Buy 1 Get 1 Free');
            $table->enum('apply_on',['1','2','3'])->comment('1:Gross Total, 2:Product, 3:Free Product');
            $table->decimal('amount')->nullable();
            $table->text('description')->nullable();
            $table->integer('usage_limit')->nullable()->comment('This is total limit of coupon');
            $table->string('used_limit')->nullable()->comment('This is for how many time the coupon is used');
            $table->enum('status',['0', '1'])->default('1')->comment('0:Inactive, 1:Active');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
