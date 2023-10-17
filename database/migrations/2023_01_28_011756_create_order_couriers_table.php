<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_couriers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('product_name');
            $table->string('product_type')->nullable();
            $table->string('from_location');
            $table->string('to_location');
            $table->string('service_price');
            $table->string('image');
            $table->string('tracking_no')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('status')->default('New');
            $table->string('courier')->nullable();
            $table->integer('courier_id')->nullable();
            $table->integer('order_note')->nullable();
            $table->integer('review')->nullable();
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
        Schema::dropIfExists('order_couriers');
    }
}