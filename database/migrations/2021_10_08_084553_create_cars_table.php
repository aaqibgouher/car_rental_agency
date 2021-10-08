<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('vehicle_model', 100);
            $table->string('vehicle_number', 100);
            $table->integer('seating_capacity');
            $table->integer('rent_per_day');
            $table->integer('is_available')->default(1)->comment("0: unavailable, 1: available");
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
        Schema::dropIfExists('cars');
    }
}
