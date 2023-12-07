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
        Schema::create('whiteboard_lectures', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('username')->nullable();
            $table->integer('lecture_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('datatype')->nullable();
            $table->longText('whiteboard_data')->nullable();
            $table->longText('data_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whiteboard_lectures');
    }
};
