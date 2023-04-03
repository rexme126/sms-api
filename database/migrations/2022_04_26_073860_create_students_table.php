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
            $table->unsignedBigInteger('klase_id');
            $table->unsignedBigInteger('guardian_id');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('term_id')->nullable();
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

            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('restrict');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('restrict');
            $table->foreign('klase_id')->references('id')->on('klases')->onDelete('restrict');
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('cascade');
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
