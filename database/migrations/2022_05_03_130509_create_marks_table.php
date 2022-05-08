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
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('klase_id');
            // $table->unsignedInteger('section_id');
            // $table->unsignedInteger('exam_id');
            $table->integer('ca1')->nullable();
            $table->integer('ca2')->nullable();
            $table->integer('tca')->nullable();
            $table->integer('exam')->nullable();
            $table->integer('exam_total')->nullable();
            // $table->integer('exm')->nullable();
            // $table->integer('tex1')->nullable();
            // $table->integer('tex2')->nullable();
            // $table->integer('tex3')->nullable();
            $table->tinyInteger('sub_position')->nullable();
            $table->integer('cum')->nullable();
            $table->string('cum_ave')->nullable();
            $table->unsignedInteger('grade_id')->nullable();
            $table->string('session');
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
