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
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id')->nullable();
            $table->string('question')->nullable();
            $table->integer('question_type')->nullable();
            $table->enum('difficulty_level',['1','2','3','4'])->comment('1=easy 2=average 3=difficult 4=very difficult')->nullable();
            $table->string('choices')->nullable();
            $table->string('answer')->nullable();
            $table->string('video_link')->nullable();
            $table->string('image_link')->nullable();
            $table->string('audio_link')->nullable();
            $table->string('points')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
