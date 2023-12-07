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
                ->count();
                
        if ($check_exisiting > 0){
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
        $score = 0;
      foreach($answers as $key => $answer){
            $questionanswer = QuizQuestion::where('id',$key)->first();
            if (strcasecmp($questionanswer->answer, $answer) == 0) {
                $score += $questionanswer->points;
            } 
            QuizStudentAnswer::create([
                'student_id' => $student_id,
                'quiz_id' => $quiz_id,
                'question_id' =>  $key,
                'student_answer' => $answer
            ]);
      } 
         

        QuizStudentScore::create([
            'student_id' => $student_id,
            'quiz_id' => $quiz_id,
            'score' => $score,
            'recorded_on' => \Carbon\Carbon::now()
        ]);
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
        }else if($status == 'complete-quizz'){
            $title = "Complete Quizz";
            $quizizzes = Quizizz::with(['totalquestions','course'])->where('status',2)->whereIn('course_id',$subcorses)->orderby('created_at','desc')->get(); 
        }else{
            $title = "UpComing Quizz";
            $quizizzes = Quizizz::with(['totalquestions','course'])->where('status',0)->whereIn('course_id',$subcorses)->orderby('created_at','desc')->get(); 

        }
        return view('quizizz.studentquiz.index',compact('quizizzes','title')); 
    }
}
