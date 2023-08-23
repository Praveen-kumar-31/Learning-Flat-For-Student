<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodingAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('coding_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('question_id');
            $table->text('answer');
            $table->text('output');
            $table->timestamps();

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('coding_answers');
    }
}
