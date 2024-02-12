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
            $table->string('name');
            $table->unsignedInteger('hall_number')->nullable();
            $table->json('number_of_seats')->nullable();
            $table->unsignedInteger('price_per_regular_seat')->nullable();
            $table->unsignedInteger('price_per_vip_seat')->nullable();
            $table->unsignedInteger('vip_seats')->nullable();
            $table->unsignedInteger('unavailable_seats')->nullable();
            $table->unsignedInteger('session_show')->nullable();
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
