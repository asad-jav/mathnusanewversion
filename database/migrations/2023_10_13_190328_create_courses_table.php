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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable(); 
            $table->integer('grade_id')->nullable(); 
            $table->string('number_of_lectures')->nullable(); 
            $table->integer('category_id')->nullable(); 
            $table->string('title')->nullable(); 
            $table->decimal('amount_in_usd')->nullable(); 
            $table->decimal('amount_in_kwd')->nullable(); 
            $table->integer('months')->nullable(); 
            $table->string('course_outline')->nullable(); 
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('seats')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
