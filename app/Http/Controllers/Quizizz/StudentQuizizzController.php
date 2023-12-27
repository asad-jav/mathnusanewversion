<?php

namespace App\Http\Controllers\Quizizz;

use App\Http\Controllers\Controller;
use App\Models\Quizizz;
use App\Models\QuizQuestion;
use App\Models\QuizStudentAnswer;
use App\Models\QuizStudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentQuizizzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Auth::user()->courses; 
        $subcorses = $courses->pluck('id')->toArray();  
        $quizizzes = Quizizz::with(['totalquestions','course'])->whereIn('course_id',$subcorses)->orderby('created_at','desc')->get(); 
        return view('quizizz.studentquiz.index',compact('quizizzes')); 
    }

    public function startQuizz($id){
        
        $student_id = Auth::user()->id; 
        $check_exisiting = QuizStudentScore::where('student_id', $student_id)
                ->where('quiz_id', $id)
                ->first();
                
        if ($check_exisiting){
            return redirect('student/quizizz')->with('failure', __('You already took the quiz.'));
        }
      $quizizzes  =  Quizizz::where('status',1)->first(); 
      $questions  =  QuizQuestion::where('quiz_id',$id)->get(); 
      if($quizizzes){ 
            return view('quizizz.studentquiz.startquizz', compact('quizizzes','questions'));
        }else{ 
            return redirect('student/quizizz')->with('failure', __('Quiz not yet started or already ended.')); 
        }

    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveQuizz(Request $request)
    { 
        $answers = $request->input('answer');
        $quiz_id = $request->input('quiz_id');
        $student_id = Auth::user()->id; 

        $check_exisiting = QuizStudentScore::where('student_id', $student_id)
                            ->where('quiz_id', $quiz_id)
                            ->count();
                            
        if ($check_exisiting > 0){ 
            return redirect('student/quizizz')->with('failure', __('You already took the quiz.'));
        }


        $score_id = QuizStudentScore::create([
            'student_id' => $student_id,
            'quiz_id' => $quiz_id, 
            'report_status' => 0, 
            'recorded_on' => \Carbon\Carbon::now()
        ]);
        foreach($answers as $key => $answer){
          $score = 0; 
            $questionanswer = QuizQuestion::where('id',$key)->first(); 
            if($questionanswer->question_type != 1){
                // dd(strcasecmp($questionanswer->answer, $answer) == 0);
                if ($questionanswer->answer == $answer) {
                    $score = $questionanswer->points;
                    $status = 1;
                    
                }
                
            }else{
                $score = 0;
                $status = 0;
            }
            QuizStudentAnswer::create([
                'student_id'            => $student_id,
                'quiz_student_score_id' => $score_id->id,
                'quiz_id'               => $quiz_id,
                'question_id'           =>  $key,
                'question_type'         => $questionanswer->question_type,
                'student_answer'        => $answer,
                'status'                => $status,
                'score'                 => $score
            ]);
           
        }  
        return redirect('student/quizizz')->with('success', __('Thanks For Giving Quizizz.'));
    }

    public function quizzReport($id){ 
        $student_id = Auth::user()->id; 
        $quiz        = Quizizz::find($id);
        $questions = QuizQuestion::where('quiz_id',$id)->get(); 
        $studentQuiz = QuizStudentScore::where('student_id',$student_id)->where('quiz_id',$id)->first(); 
        $quizAnswers = QuizStudentAnswer::where('student_id',$student_id)->where('quiz_id',$id)->get();  
        return view('quizizz.studentquiz.quizzReport', compact('quiz','questions','studentQuiz','quizAnswers'));
    }

    public function QuizStatus($status){ 
        $courses = Auth::user()->courses; 
        $subcorses = $courses->pluck('id')->toArray();  
        if($status == 'live-quizz'){
            $title = "Live Quizz";
            $quizizzes = Quizizz::with(['totalquestions','course'])->where('status',1)->whereIn('course_id',$subcorses)->orderby('created_at','desc')->get(); 
        
            return view('quizizz.studentquiz.index',compact('quizizzes','title')); 
        }else if($status == 'complete-quizz'){
            $title = "Complete Quizz";
            $quizizzes = QuizStudentScore::with('quiz')->where('student_id',Auth::user()->id)->get();  
            return view('quizizz.studentquiz.completeQuiz',compact('quizizzes','title')); 
        }else{
            $title = "UpComing Quizz";
            $quizizzes = Quizizz::with(['totalquestions','course'])->where('status',0)->whereIn('course_id',$subcorses)->orderby('created_at','desc')->get(); 

        }
        return view('quizizz.studentquiz.index',compact('quizizzes','title')); 
    }

    public function markStudentAnswer(Request $request){
        $quizmarked = QuizStudentAnswer::where('id',$request->student_answer_id)->first();
        $quizmarked->status = 1;
        $quizmarked->score  = $request->student_points;
        $quizmarked->update();
        return back()->with('success', __('Student Quiz marked successfuly'));

    }
}
