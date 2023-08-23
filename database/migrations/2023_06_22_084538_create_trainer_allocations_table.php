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
         Schema::create('allocation_trainers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batches');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('section_id')->constrained('sections');
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('trainer1_id')->constrained('trainers');
            $table->foreignId('trainer2_id')->constrained('trainers');
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
        Schema::dropIfExists('allocation_trainers');
    }
};