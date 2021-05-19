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
            $table->id();
       
            $table->unsignedBigInteger('user_id');
            $table->foreign("user_id")->references("id")->on("Users")->onDelete("cascade");
            $table->unsignedBigInteger('address_id');
            $table->foreign("address_id")->references("id")->on("adresses");
            $table->decimal('total_price');
            $table->string('order_status');
            $table->string('order_type');
            $table->decimal('delivery_charge')->nullable();
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
