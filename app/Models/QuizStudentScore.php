<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizStudentScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'quiz_id',
        'score',
        'recorded_on',
    ];
}
