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
            $table->integer('hall_number')->nullable()->default(null);
            $table->text('number_of_seats')->nullable()->default(null);
            $table->float('price_per_regular_seat')->nullable()->default(null);
            $table->float('price_per_vip_seat')->nullable()->default(null);
            $table->integer('vip_seats')->nullable()->default(null);
            $table->integer('unavailable_seats')->nullable()->default(null);
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
