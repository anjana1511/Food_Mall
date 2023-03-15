<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->increments('order_details_id');
            $table->integer('order_id')->nullable();
            $table->integer('menu_id')->nullable();
            $table->integer('food_id')->nullable();
            $table->integer('quantity');
            $table->integer('amount');
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
            $table->foreign('menu_id')->references('menu_id')->on('menu')->onDelete('cascade');

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
        Schema::dropIfExists('orderdetails');
    }
}
