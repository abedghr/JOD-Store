<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('from_provider')->unsigned()->nullable();
            $table->bigInteger('from_user')->unsigned()->nullable();
            $table->bigInteger('to_provider')->unsigned()->nullable();
            $table->bigInteger('to_user')->unsigned()->nullable();
            $table->foreign('from_provider')->references('id')->on('providers')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('to_provider')->references('id')->on('providers')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('from_user')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('to_user')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->text('message');
            $table->tinyInteger('is_read');
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
        Schema::dropIfExists('messages');
    }
}
