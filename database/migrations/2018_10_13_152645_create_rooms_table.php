<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
          $table->increments('id');
          $table->text('name');
          $table->integer('beds');
          $table->text('description')->nullable();
          $table->text('slogan')->nullable();
          $table->integer('starting_price')->nullable();
          $table->integer('bathroom')->default('0');
          $table->integer('kitchen')->default('0');
          $table->integer('terrace')->default('0');
          $table->integer('air_conditioner')->default('0');
          $table->integer('tv')->default('0');
          $table->integer('wifi')->default('0');
          $table->text('other_amenities')->nullable();
          $table->string('profile_img')->default('1.jpg');
          $table->string('cover_img')->default('cover.jpg');
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
        Schema::dropIfExists('rooms');
    }
}
