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
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('klase_id');
            $table->unsignedInteger('guardian_id');
            $table->unsignedInteger('section_id')->nullable();
            $table->unsignedInteger('session_id')->nullable();
            $table->unsignedInteger('term_id')->nullable();
            $table->integer('promotion_term_id')->default(3);
            $table->integer('cum_avg')->nullable();
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
