<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['1', '2'])->default('1')->comment('1:Simple, 2:Variable');
            $table->unsignedBigInteger('category_id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('regular_price')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->string('sku')->nullable();
            $table->string('stock_status')->nullable();
            $table->text('product_information')->nullable();
            $table->text('additional_information')->nullable();
            $table->enum('status',['0', '1', '2'])->default('2')->comment('0:Inactive, 1:Active, 2:Pending');
            $table->string('step_status')->default('0');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
