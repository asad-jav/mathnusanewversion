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
        Schema::create('quizizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('standard_id')->nullable();
            $table->integer('grade_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('status')->nullable();
            $table->integer('report_status')->default(0);
            $table->integer('easy_level')->default(0);
            $table->integer('average_level')->default(0);
            $table->integer('difficult_level')->default(0);
            $table->integer('very_difficult_level')->default(0);
            $table->bigInteger('total_questions')->default(0);
            $table->bigInteger('passing_marks')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizizzes');
    }
};
