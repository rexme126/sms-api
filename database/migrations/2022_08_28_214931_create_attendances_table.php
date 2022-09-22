<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('klase_id');
            $table->unsignedInteger('term_id');
            $table->unsignedInteger('session_id');
            $table->unsignedInteger('section_id');
            $table->string('date')->nullable();
            $table->integer('status')->nullable();
            $table->integer('num_present')->nullable();
            $table->integer('num_absent')->nullable();
            $table->integer('num_total')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
