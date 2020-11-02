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
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->nullable();
            $table->string('phone',15);
            $table->string('phone2',15)->nullable();
            $table->string('city');
            $table->string('Address');
            $table->text('notes')->nullable();
            $table->bigInteger('provider')->unsigned();
            $table->double('total_price');
            $table->double('total_With_Delivery');
            $table->smallInteger('order_status')->default(0);
            $table->string('payment_method')->default('Cash on delivery');
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
        Schema::dropIfExists('orders');
    }
}
