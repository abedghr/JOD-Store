<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('store_type')->nullable();
            $table->text('address')->nullable();
            $table->text('image')->default('default_provider.png');
            $table->bigInteger('visitors')->default(0);
            $table->bigInteger('subscribe')->default(0);
            $table->text('cover_image')->default('default_cover.jpg');
            $table->text('description')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('providers');
    }
}
