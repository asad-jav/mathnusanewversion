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
        Schema::create('quiz_student_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('quiz_id')->nullable();
            $table->integer('score')->nullable();
            $table->timestamp('recorded_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_student_scores');
    }
};
