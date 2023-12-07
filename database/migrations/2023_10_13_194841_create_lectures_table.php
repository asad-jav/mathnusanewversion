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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('topic_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('title')->nullable();
            $table->text('outline')->nullable();
            $table->decimal('duration')->nullable();
            $table->date('datetime')->nullable();
            $table->string('start_time')->nullable();
            $table->integer('lecture_number')->nullable();
            $table->integer('session_number')->nullable();
            $table->integer('enrol_limit')->nullable();
            $table->integer('enrol_count')->nullable();
            $table->integer('status')->nullable();
            $table->integer('state')->nullable();
            $table->text('whiteboard')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
