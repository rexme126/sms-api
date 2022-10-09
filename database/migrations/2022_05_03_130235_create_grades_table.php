<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workspace_id')->nullable();
            $table->string('name');
           // $table->unsignedInteger('klase_id')->nullable();
            $table->tinyInteger('mark_from');
            $table->tinyInteger('mark_to');
            $table->string('remark')->nullable();
            $table->timestamps();
        });
        //   Schema::table('grades', function (Blueprint $table) {
        //     $table->unique(['name', 'klase_id', 'remark']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
