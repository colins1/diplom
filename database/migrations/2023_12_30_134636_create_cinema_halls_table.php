<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinema_halls', function (Blueprint $table) {
            $table->id();
            $table->integer('hall_number');
            $table->integer('number_of_seats');
            $table->float('price_per_regular_seat');
            $table->float('price_per_vip_seat');
            $table->text('vip_seats')->nullable();
            $table->text('unavailable_seats')->nullable();
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
        Schema::dropIfExists('cinema_halls');
    }
};
