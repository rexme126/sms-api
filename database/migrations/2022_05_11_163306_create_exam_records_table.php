<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('klase_id');
            $table->unsignedInteger('term_id');
            $table->unsignedInteger('section_id')->nullable();
            $table->unsignedInteger('session_id')->nullable();
            $table->integer('total')->nullable();
            $table->integer('cum_total')->nullable();
            $table->string('avg')->nullable();
            $table->string('cum_avg')->nullable();
            $table->string('klase_avg')->nullable();
            $table->integer('position')->nullable();
            $table->string('status')->default('unpublished');
            $table->string('af')->nullable();
            $table->string('ps')->nullable();
            $table->string('p_comment')->nullable();
            $table->string('t_comment')->nullable();
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
        Schema::dropIfExists('exam_records');
    }
}
