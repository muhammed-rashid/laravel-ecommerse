<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_details', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_charge')->nullable();
            $table->string('min_order_amount')->nullable();
            $table->string('support_whatsapp_number')->nullable();
            $table->string('support_number')->nullable();
            $table->string('support_email')->nullable();
            $table->text('store_adress')->nullable();
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
        Schema::dropIfExists('general_details');
    }
}
