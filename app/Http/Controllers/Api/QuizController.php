<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quizizz;
use App\Models\QuizQuestion;
use App\Models\QuizStudentAnswer;
use App\Models\QuizStudentScore;
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
            $courses    = Auth::user()->courses;  
            $subcorses  = $courses->pluck('id')->toArray(); 
            $quizzes    =  Quizizz::with('grade')
            ->select('quizizzes.*', 
                DB::raw('(SELECT SUM(points) FROM quiz_questions WHERE quiz_questions.quiz_id = quizizzes.id) as total_points'))
            ->where('status', 1)
            ->whereIn('course_id', $subcorses)
            ->get();
            if(count($quizzes) > 0)
            {
                
                return $this->sendResponse(['quiz' => $quizzes], 'CFU Found');  
            }
            else
            { 
                return $this->sendError("CFU Not Found",[],404); 
            }
        }
        else 
        {
            
            return $this->sendError("Unauthorized. Please provide a valid access token.",[],401);  
        }
    }

    
    public function show_quiz_question(Request $request)
    {
        if (!$request->quiz_id) {
            return $this->sendError("CFU questions do not exist.", [], 404);
        }
        
        $quiz_id = $request->quiz_id;
        $passing_points = Quizizz::where('id', $quiz_id)->pluck('passing_marks')->first();
        $quizizz_points = QuizQuestion::where('quiz_id', $quiz_id)->sum('points');
        $quizizz = QuizQuestion::where('quiz_id', $quiz_id)->get();
    
        // Define your base URL here
        $baseUrl = url('/').'/'; // Adjust according to your base URL structure
    
        // Define an array of difficulty levels
        $difficultyLevels = [
            '1' => 'easy',
            '2' => 'average',
            '3' => 'difficult',
            '4' => 'very difficult',
        ];
    
        // Initialize an empty array for the response
        $response = [];
    
        // Loop through all difficulty levels
        foreach ($difficultyLevels as $difficultyId => $difficultyName) {
            // Initialize an empty array for questions of this difficulty level
            $response['difficulty_levels'][$difficultyName] = [];
    
            // Get questions for this difficulty level
            $questions = $quizizz->where('difficulty_level', $difficultyId);
    
            // Add questions to the response array
            foreach ($questions as $question) {
                // Append the base URL to image and video links if they are not empty
                if (!empty($question->image_link)) {
                    $question->image_link = $baseUrl . $question->image_link;
                }
                if (!empty($question->video_link)) {
                    $question->video_link = $baseUrl . $question->video_link;
                }
                $response['difficulty_levels'][$difficultyName][] = $question;
            }
        }
    
        // Check if any questions are found
        if (empty($response['difficulty_levels'])) {
            return $this->sendError("CFU Question Not Found", [], 404);
        }
    
        return $this->sendResponse([
            'Quiz_points' => $quizizz_points,
            'passing_marks' => $passing_points,
            'quiz_questions' => $response
        ], 'CFU Questions Found');
    }
    

    public function cfuQuestionAnswer(Request $request) {
        $user = Auth::user();
        if($user)
        {  
            $status = 0;
            $score = 0;
            $answer = $request->answer;
            $student_id = $user->id;
            $score_id = QuizStudentScore::updateOrCreate(
                ['student_id' => $student_id, 'quiz_id' => $request->quiz_id],
                [
                    'student_id' => $student_id,
                    'quiz_id' => $request->quiz_id,
                    'report_status' => 0,
                'recorded_on' => \Carbon\Carbon::now()
                ]
            );
            $questionanswer = QuizQuestion::where('quiz_id', $request->quiz_id)->where('id', $request->question_id)->first();
            if($questionanswer){
                $oldanswer = QuizStudentAnswer::where('quiz_id', $request->quiz_id)->where('question_id', $request->question_id)->where('student_id',$user->id)->first();
                if($oldanswer){
                    
                    return $this->sendResponse(['answer' => $oldanswer], 'Answer Marked Already');  
                }else{
                    if ($questionanswer->question_type != 1) {
                        // dd(strcasecmp($questionanswer->answer, $answer) == 0);
                        if ($questionanswer->answer == $answer) {
                            $score = $questionanswer->points;
                            $status = 1;
                        }else {
                            $score = 0;
                            $status = 0;
                        }
                    } else {
                        $score = 0;
                        $status = 0;
                    }
                    $quizStudentAnswer                          = new QuizStudentAnswer();
                    $quizStudentAnswer->student_id              = $student_id;
                    $quizStudentAnswer->quiz_student_score_id   = $score_id->id;
                    $quizStudentAnswer->quiz_id                 = $request->quiz_id;
                    $quizStudentAnswer->question_id             = $request->question_id;
                    $quizStudentAnswer->question_type           = $questionanswer->question_type;
                    $quizStudentAnswer->student_answer          = $answer;
                    $quizStudentAnswer->attempted               = 'true';
                    $quizStudentAnswer->status                  = $status;
                    $quizStudentAnswer->score                   = $score;
                    $quizStudentAnswer->save();
                    return $this->sendResponse(['answer' => $quizStudentAnswer], 'Answer Marked Successfully');  
                }
            }else{ 
                return $this->sendError("Question not found.",[],401);  
            } 
        }
        else 
        {
            
            return $this->sendError("Unauthorized. Please provide a valid access token.",[],401);  
        }
    }
    
     public function studentCfuReport(Request $request)
    {  
        $user = Auth::user();
        if($user)
        {  
            $totalquestion         = QuizQuestion::where('quiz_id',$request->quiz_id)->count();
            $totalquizmarked       = QuizQuestion::where('quiz_id',$request->quiz_id)->sum('points');
            $attempted             =  QuizStudentAnswer::where('quiz_id', $request->quiz_id)->where('student_id',$user->id)->count();
            $quizmarked            = QuizStudentScore::with('student','student_answers','quiz')
                                    ->where('quiz_id', $request->quiz_id)
                                    ->where('student_id', $user->id)
                                    ->first();
            if ($quizmarked !== null) {
                // Sum of all scores
                $studentscore = $quizmarked->student_answers->sum('score');
                // Sum of scores where score is null
                $falsequestion = $quizmarked->student_answers->whereNull('score',0)->count();
                // Sum of scores where score is not null
                $rightquestion = $quizmarked->student_answers->where('score','!=',0)->count();
            }else{
                // Sum of all scores
                $studentscore = 0;
                // Sum of scores where score is null
                $falsequestion = 0;
                // Sum of scores where score is not null
                $rightquestion = 0;
            }
            $data          = [      
                'totalquestion'             => $totalquestion,
                'totalquizmarked'           => $totalquizmarked,
                'studentscore'              => $studentscore,
                'attemptedquestioin'       => $attempted,
                'falsequestion'             => $falsequestion,
                'rightquestion'             => $rightquestion
            ];
            
            return $this->sendResponse($data, 'CFU Marks Report');  
        } else 
        {
            
            return $this->sendError("Unauthorized. Please provide a valid access token.",[],401);  
        }
    }
 
     public function cfuLeaderBoard(Request $request)
    {  
        $user = Auth::user();
        if($user)
        {  
            $totalquestion         = QuizQuestion::where('quiz_id',$request->quiz_id)->count();
            $totalquizmarked       = QuizQuestion::where('quiz_id',$request->quiz_id)->sum('points');
            $attempted             = QuizStudentAnswer::where('quiz_id', $request->quiz_id)->where('student_id',$user->id)->count();
            $quizmarkeds            = QuizStudentScore::with('student')
                                    ->where('quiz_id', $request->quiz_id)
                                    ->get();
            $data = [];         
            foreach($quizmarkeds as $quizmarked){
                if ($quizmarked !== null) {
                    // Sum of all scores
                    $studentscore = $quizmarked->student_answers->sum('score');
                    // Sum of scores where score is null
                    $falsequestion = $quizmarked->student_answers->whereNull('score',0)->count();
                    // Sum of scores where score is not null
                    $rightquestion = $quizmarked->student_answers->where('score','!=',0)->count();
                }else{
                    // Sum of all scores
                    $studentscore = 0;
                    // Sum of scores where score is null
                    $falsequestion = 0;
                    // Sum of scores where score is not null
                    $rightquestion = 0;
                }
                $data[]  = [    
                    'studetnt'                  => $quizmarked->student,
                    'totalquestion'             => $totalquestion,
                    'totalquizmarked'           => $totalquizmarked,
                    'studentscore'              => $studentscore,
                    'attemptedquestioin'       => $attempted,
                    'falsequestion'             => $falsequestion,
                    'rightquestion'             => $rightquestion
                ];
            }
            
            return $this->sendResponse($data, 'CFU Leader Board');  
        } else 
        {
            
            return $this->sendError("Unauthorized. Please provide a valid access token.",[],401);  
        }
    }
    
    public function cfuStudentKills(Request $request){
         
        $user = Auth::user();
        if($user)
        {  
            $quizStudentScore = QuizStudentScore::select('quiz_id','student_id','kills')->where('student_id', $request->student_id)->where('quiz_id',$request->quiz_id)->first();
            return $this->sendResponse($quizStudentScore, 'CFU Student Kills');  
        } else 
        {
            
            return $this->sendError("Unauthorized. Please provide a valid access token.",[],401);  
        }
    }
    
     public function cfuAddStudentKills(Request $request){
        $user = Auth::user();
        if($user)
        {  
            $quizStudentScore = QuizStudentScore::where('student_id', $request->student_id)->where('quiz_id',$request->quiz_id)->first();
            $quizStudentScore->kills = $quizStudentScore->kills +  $request->kills;
            $quizStudentScore->save();
            return $this->sendResponse($quizStudentScore, 'CFU Kill Add Successfully');  
        } else 
        {
            
            return $this->sendError("Unauthorized. Please provide a valid access token.",[],401);  
        }
    }
    
        
     public function cfuKillsleaderBoard(Request $request){
        $user = Auth::user();
        if($user)
        {  
            $quizkillsLeaderboard = QuizStudentScore::with('student')->where('quiz_id',$request->quiz_id)->orderBy('kills','desc')->get();
            return $this->sendResponse($quizkillsLeaderboard, 'CFU Kill Leader Board');  
        } else 
        {
            
            return $this->sendError("Unauthorized. Please provide a valid access token.",[],401);  
        }
    }
}
