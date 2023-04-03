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
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('from_class');
            $table->string('from_session');
            $table->unsignedBigInteger('from_term');
            $table->unsignedBigInteger('to_class');
            $table->unsignedBigInteger('to_term')->default(1);
            $table->string('to_session');
            $table->boolean('status')->default(false);
            $table->integer('cum_avg')->nullable();
            $table->timestamps();
            $table->foreign('from_class')->references('id')->on('klases');
            $table->foreign('to_class')->references('id')->on('klases');

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
        Schema::dropIfExists('promotions');
    }
}
