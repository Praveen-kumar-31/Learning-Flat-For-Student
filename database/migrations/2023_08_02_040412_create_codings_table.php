<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course');
            $table->unsignedBigInteger('topic');
            $table->unsignedBigInteger('subtopic');
            $table->text('question');
            $table->text('sample_input1');
            $table->text('sample_input2');
            $table->text('sample_input3');
            $table->text('sample_input4');
            $table->text('sample_output1');
            $table->text('sample_output2');
            $table->text('sample_output3');
            $table->text('sample_output4');
            $table->unsignedTinyInteger('type');
            $table->timestamps();

            // Define foreign key constraints if necessary
            $table->foreign('course')->references('id')->on('courses')->cascadeOnDelete();
            $table->foreign('topic')->references('id')->on('topics')->cascadeOnDelete();
            $table->foreign('subtopic')->references('id')->on('subtopics')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codings');
    }
};
