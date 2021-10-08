<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('car_id');
            $table->integer('number_of_days')->default(0);
            $table->datetime('from_date')->nullable();
            $table->datetime('to_date')->nullable();
            $table->integer('total_fare')->default(0);
            $table->integer('is_deleted')->default(0)->comment("0: not deleted, 1: deleted");
            $table->timestamps();
            $table->integer('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
