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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('from')->nullable();
            $table->integer('to')->nullable();
            $table->text('message')->nullable();
            $table->integer('is_read')->nullable();
            $table->string('file')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('type')->nullable();
            $table->string('channel')->nullable();
            $table->integer('message_type')->nullable();
            $table->integer('lecture_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
