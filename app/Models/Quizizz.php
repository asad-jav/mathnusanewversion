<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizizz extends Model
{
    use HasFactory;
    protected $table = "quizizzes";
    protected $guarded = [];
    protected $fillable = [
        'title', 
        'course_id',
        'standard_id',
        'grade_id',
        'start_date',
        'end_date',
        'status',
        'description',
        'passing_marks',

    ];
    public function course(){
        return $this->belongsTo(Course::class);
    } 
    public function totalquestions(){ 
        return $this->hasMany(QuizQuestion::class,'quiz_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id', 'id');
    }

}
