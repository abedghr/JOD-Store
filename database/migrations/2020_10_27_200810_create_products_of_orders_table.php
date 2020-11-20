<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOfOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_of_orders', function (Blueprint $table) {
            $table->id();
            $table->string('prod_name');
            $table->double('new_price');
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('category')->unsigned();
            $table->bigInteger('provider')->unsigned();
            $table->text('colors')->nullable()->default('');
            $table->text('main_image')->default('product_default.jpg');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider')->references('id')->on('providers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('products_of_orders');
    }
}
