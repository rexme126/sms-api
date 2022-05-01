<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('blood_group_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('city_id');
            $table->string('lga')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('photo')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('route')->nullable();
            $table->string('driver_license')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('phone');       
            $table->string('religion')->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
