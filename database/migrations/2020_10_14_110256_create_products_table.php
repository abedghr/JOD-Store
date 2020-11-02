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
            $table->bigIncrements('id');
            $table->string('prod_name');
            $table->text('description');
            $table->double('old_price')->nullable();
            $table->double('new_price');
            $table->bigInteger('category')->unsigned();
            $table->string('gender');
            $table->bigInteger('provider')->unsigned();
            $table->text('main_image')->default('product_default.jpg');
            $table->smallInteger('availability')->default(1);
            $table->string('prod_status')->nullable();
            $table->string('country_made')->nullable();
            $table->bigInteger('number_of_bought')->nullable()->default(0);
            $table->text('colors')->nullable()->default('');
            $table->integer('inventory')->default(100);
            $table->bigInteger('prod_related')->unsigned()->nullable();
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('provider')->references('id')->on('providers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('prod_related')->references('id')->on('related')->onDelete('cascade')->onUpdate('cascade');
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
