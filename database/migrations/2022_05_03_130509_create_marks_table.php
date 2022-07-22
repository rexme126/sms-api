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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('klase_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('term_id');
            $table->unsignedInteger('grade_id')->nullable();
            $table->unsignedInteger('session_id');
            // $table->unsignedInteger('section_id');
            // $table->unsignedInteger('exam_id');
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
