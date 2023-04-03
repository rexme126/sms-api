<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('klase_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('section_id');
            $table->integer('total')->nullable();
            $table->string('ave')->nullable();
            $table->string('klase_ave')->nullable();
            $table->integer('position')->nullable();
            $table->string('af')->nullable();
            $table->string('ps')->nullable();
            $table->string('p_comment')->nullable();
            $table->string('t_comment')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('results');
    }
}
