<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->unsignedInteger('payment_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('klase_id');
            $table->unsignedInteger('term_id');
            $table->unsignedInteger('session_id');
            $table->string('ref_no', 100)->unique()->nullable();
            $table->string('title', 50)->default('School Fee Payment');
            $table->string('status', 20)->default('Due');
            $table->integer('receipt')->unique()->nullable();
            $table->integer('amt_paid')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('balance')->nullable();
            $table->string('paid')->default('Due');
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
        Schema::dropIfExists('payment_records');
    }
}
