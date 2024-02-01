<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizStudentAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'quiz_id',
        'question_id',
        'quiz_student_score_id',
        'question_type',
        'student_answer',
        'status',
        'score',
        'feedback'
    ];

    public function question(){
        return $this->belongsTo(QuizQuestion::class,'question_id');
    }
}
