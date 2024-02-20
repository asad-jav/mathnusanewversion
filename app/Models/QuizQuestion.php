<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;
    protected $table = 'quiz_questions';
    protected $guarded = [];
    protected $fillable = ['quiz_id','question','question_type','difficulty_level','image_link','video_link','answer','points','choices'];

}
