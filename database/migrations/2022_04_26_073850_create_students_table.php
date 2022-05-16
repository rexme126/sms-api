<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('klase_id');
            $table->unsignedInteger('guardian_id');
            $table->string('term_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('slug')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('gender')->nullable();
            $table->string('code');
            $table->string('birthday')->nullable();
            $table->string('adm_no')->nullable();
            $table->boolean('status')->default(false);
            $table->string('address')->nullable();
            $table->string('admitted_year')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_no')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('guardian_email')->nullable();
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
        Schema::dropIfExists('students');
    }
}
