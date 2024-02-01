<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_student_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('quiz_student_score_id')->nullable();
            $table->integer('question_type')->nullable();
            $table->integer('status')->nullable();
            $table->integer('score')->nullable();
            $table->longText('feedback')->nullable();
            $table->integer('quiz_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->string('student_answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_student_answers');
    }
};
