<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('klase_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->unsignedBigInteger('session_id');
            $table->integer('ca1')->nullable();
            $table->integer('ca2')->nullable();
            $table->integer('tca')->nullable();
            $table->integer('exam')->nullable();
            $table->string('status')->default('unpublished');
            $table->integer('exam_total')->nullable();
            $table->tinyInteger('sub_position')->nullable();
            $table->integer('cum')->nullable();
            $table->string('cum_ave')->nullable();
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('marks');
    }
}
