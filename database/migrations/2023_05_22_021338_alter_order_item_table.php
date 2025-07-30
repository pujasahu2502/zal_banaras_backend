<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function($table) {
            $table->string('variation_id')->nullable();
            $table->string('tax_class')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('subtotal_tax')->nullable();
            $table->string('total')->nullable();
            $table->string('total_tax')->nullable();
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
