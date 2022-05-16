<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('from_class');
            // $table->unsignedInteger('from_section');
            $table->unsignedBigInteger('to_class');
            // $table->unsignedInteger('to_section');
            $table->string('from_session');
            $table->string('to_session');
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('from_class')->references('id')->on('klases');
            $table->foreign('to_class')->references('id')->on('klases');
        });

         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
