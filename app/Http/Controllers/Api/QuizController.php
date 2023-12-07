<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quizizz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function show_quiz()
    {
        $user = Auth::user();
        if($user)
        {
            $quizizz = Quizizz::where('status',1)->OrderBy('id','desc')->get();
            if(count($quizizz) > 0)
            {
                return response()->json(['message' => 'Quiz Found','quiz' => $quizizz], 200);
            }
            else
            {
                return response()->json(['error' => 'Quiz Not Found'], 404);
            }
        }
        else 
        {
            return response()->json(['error' => 'Unauthorized. Please provide a valid access token.'], 401);
        }
    }

    
    public function show_quiz_question($quiz_id,$level_id)
    {
        $passing_points = Quizizz::where('id',$quiz_id)->pluck('passing_marks')->first();
        $quizizz_points = QuizQuestion::where('quiz_id',$quiz_id)->where('difficulty_level',$level_id)->sum('points');
        $quizizz = QuizQuestion::where('quiz_id', $quiz_id)->get();
        // Define an array of difficulty levels
        $difficultyLevels = [
            '1' => 'easy',
            '2' => 'average',
            '3' => 'difficult',
            '4' => 'very difficult',
        ];
        // Initialize an empty array for the response
        $response = [];
        foreach ($difficultyLevels as $difficultyId => $difficultyName) {
            $questions = $quizizz->where('difficulty_level', $difficultyId);
        
            // Check if there are questions for this difficulty level
            if ($questions->isNotEmpty()) {
                $response['difficulty_levels'][$difficultyName] = [
                    'questions' => $questions,
                    'total_points' => $questions->sum('points'),
                ];
            }
        }
        
        if (count($response) > 0) {
            return response()->json(['message' => 'Quiz Questions Found', 'data' => $response], 200);
        } else {
            return response()->json(['error' => 'Quiz Question Not Found'], 404);
        }
        
    }
}
