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
        Schema::disableForeignKeyConstraints();
        Schema::create('grades', function (Blueprint $table) {
            $table->id()->length(11);
            $table->bigInteger('students_id')->unsigned()->index();
            $table->integer('subject')->length(11);
            $table->integer('grade')->length(11);
            $table->timestamps();
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();

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
