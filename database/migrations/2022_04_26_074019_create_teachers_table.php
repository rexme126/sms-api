<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('slug')->unique();
            $table->string('first_name');
            $table->string('last_name');
             $table->string('gender');
            $table->string('middle_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('code');
            $table->string('photo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('qualification')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
