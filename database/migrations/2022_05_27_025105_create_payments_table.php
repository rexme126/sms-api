<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->unsignedInteger('klase_id')->nullable();
            $table->unsignedInteger('term_id')->nullable();
            $table->unsignedInteger('session_id')->nullable();
            $table->string('title')->nullable();
            $table->string('status', 20)->default('Due');
            $table->integer('amount')->nullable();
            $table->string('method', 100)->default('cash');
            $table->string('description')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('payments');
    }
}
