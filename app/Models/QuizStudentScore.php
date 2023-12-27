<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class QuizStudentScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'quiz_id',
        'score',
        'report_status',
        'recorded_on',
    ];

    public function quiz(){
        return $this->belongsTo(Quizizz::class,'quiz_id');
    }

    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }

   
    public function student_answers(){
        return $this->hasMany(QuizStudentAnswer::class,'quiz_student_score_id');
    }
}
