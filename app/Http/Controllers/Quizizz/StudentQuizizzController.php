<?php

namespace App\Http\Controllers\Quizizz;

use App\Http\Controllers\Controller;
use App\Models\Quizizz;
use App\Models\QuizQuestion;
use App\Models\QuizStudentAnswer;
use App\Models\QuizStudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $quizizzes = Quizizz::with(['totalquestions', 'course'])->whereIn('course_id', $subcorses)->orderby('created_at', 'desc')->get();
        return view('quizizz.studentquiz.index', compact('quizizzes'));
    }

    public function startQuizz($id)
    {

        $student_id = Auth::user()->id;
        $check_exisiting = QuizStudentScore::where('student_id', $student_id)
            ->where('quiz_id', $id)
            ->first();

        if ($check_exisiting) {
            return redirect('student/quizizz')->with('failure', __('You already took the quiz.'));
        }
        $quizizzes  =  Quizizz::where('status', 1)->first();
        $questions  =  QuizQuestion::where('quiz_id', $id)->get();
        if ($quizizzes) {
            return view('quizizz.studentquiz.startquizz', compact('quizizzes', 'questions'));
        } else {
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

        if ($check_exisiting > 0) {
            return redirect('student/quizizz')->with('failure', __('You already took the quiz.'));
        }


        $score_id = QuizStudentScore::create([
            'student_id' => $student_id,
            'quiz_id' => $quiz_id,
            'report_status' => 0,
            'recorded_on' => \Carbon\Carbon::now()
        ]);
        foreach ($answers as $key => $answer) {
            $score = 0;
            $questionanswer = QuizQuestion::where('id', $key)->first();
            if ($questionanswer->question_type != 1) {
                // dd(strcasecmp($questionanswer->answer, $answer) == 0);
                if ($questionanswer->answer == $answer) {
                    $score = $questionanswer->points;
                    $status = 1;
                }
            } else {
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

    public function quizzReport($quiz_id)
    {
        $student_id = Auth::user()->id;
        $totalquestion         = QuizQuestion::where('quiz_id',$quiz_id)->count();
        $totalquizmarked       = QuizQuestion::where('quiz_id',$quiz_id)->sum('points');
        $quizmarked            = QuizStudentScore::with('student','student_answers','quiz')
                                ->where('quiz_id', $quiz_id)
                                ->where('student_id', $student_id)
                                ->first();
        // Sum of all scores
        $studentscore = $quizmarked->student_answers->sum('score');
        // Sum of scores where score is null
        $falsequestion = $quizmarked->student_answers->whereNull('score')->sum('score');
        // Sum of scores where score is not null
        $rightquestion = $quizmarked->student_answers->whereNotNull('score')->sum('score');
        $data          = [      'totalquestion'   => $totalquestion,
                                'totalquizmarked' => $totalquizmarked,
                                'studentscore'    => $studentscore,
                                'falsequestion'   => $falsequestion,
                                'rightquestion'   => $rightquestion
                         ];
        return view('Quizizz.studentquiz.singleQuizReport',compact('quizmarked','data'));
    }

    public function QuizStatus($status)
    {
        $courses = Auth::user()->courses;
        $subcorses = $courses->pluck('id')->toArray();
        if ($status == 'live-quizz') {
            $title = "Live Quizz";
            $quizizzes = Quizizz::with(['totalquestions', 'course'])->where('status', 1)->whereIn('course_id', $subcorses)->orderby('created_at', 'desc')->get();

            return view('quizizz.studentquiz.index', compact('quizizzes', 'title'));
        } else if ($status == 'complete-quizz') {
            $title = "Complete Quizz";
            $quizizzes = QuizStudentScore::with('quiz')->where('student_id', Auth::user()->id)->get();
            return view('quizizz.studentquiz.completeQuiz', compact('quizizzes', 'title'));
        } else {
            $title = "UpComing Quizz";
            $quizizzes = Quizizz::with(['totalquestions', 'course'])->where('status', 0)->whereIn('course_id', $subcorses)->orderby('created_at', 'desc')->get();
        }
        return view('quizizz.studentquiz.index', compact('quizizzes', 'title'));
    }

    public function markStudentAnswer(Request $request)
    {
        $quizmarked = QuizStudentAnswer::where('id', $request->student_answer_id)->first();
        $quizmarked->status = 1;
        $quizmarked->score  = $request->student_points;
        $quizmarked->update();
        return back()->with('success', __('Student Quiz marked successfuly'));
    }


    public function studentQuizReport($quiz_id, $student_id)
    {
        $totalquestion         = QuizQuestion::where('quiz_id',$quiz_id)->count();
        $totalquizmarked       = QuizQuestion::where('quiz_id',$quiz_id)->sum('points');
        $quizmarked            = QuizStudentScore::with('student','student_answers','quiz')
                                ->where('quiz_id', $quiz_id)
                                ->where('student_id', $student_id)
                                ->first();
        // Sum of all scores
        $studentscore = $quizmarked->student_answers->sum('score');
        // Sum of scores where score is null
        $falsequestion = $quizmarked->student_answers->whereNull('score')->sum('score');
        // Sum of scores where score is not null
        $rightquestion = $quizmarked->student_answers->whereNotNull('score')->sum('score');
        $data          = [      'totalquestion'   => $totalquestion,
                                'totalquizmarked' => $totalquizmarked,
                                'studentscore'    => $studentscore,
                                'falsequestion'   => $falsequestion,
                                'rightquestion'   => $rightquestion
                         ];
        return view('quizizz.studentquiz.singleQuizReport',compact('quizmarked','data'));
    }

    public function studentQuizReportStatus($status,$quiz_id){
        $quizz = Quizizz::where('id',$quiz_id)->first();
        if($quizz->status == 2){
            if($status == 'enable'){ 
                $quizz->report_status = 1;
            }elseif($status == 'disable'){
                $quizz->report_status = 0;
            } 
            $quizz->update(); 
            return back()->with('success', __('Quizz report'.$status.' successfully'));

        }else{
            return back()->with('failure', __("Quizz report can't live until quizz status completed"));
        }
    }

    public function quizReportView($quizz_id)
    {
        $quiz = Quizizz::where('id',$quizz_id)->first();
        $data = QuizStudentScore::with(['student', 'student_answers', 'quiz'])
        ->selectRaw('
            quiz_student_scores.id,
            quiz_student_scores.student_id,
            quiz_student_scores.quiz_id,
            COUNT(quiz_questions.id) as totalquestion,
            SUM(quiz_questions.points) as totalquizmarked,
            SUM(quiz_student_answers.score) as studentscore,
            SUM(CASE WHEN quiz_student_answers.score = 0 THEN 1 ELSE 0 END) as falsequestion,
            SUM(CASE WHEN quiz_student_answers.score > 0 THEN 1 ELSE 0 END) as rightquestion
        ')
        ->join('quizizzes', 'quizizzes.id', '=', 'quiz_student_scores.quiz_id')
        ->join('quiz_questions', 'quiz_questions.quiz_id', '=', 'quizizzes.id')
        ->leftJoin('quiz_student_answers', function ($join) {
            $join->on('quiz_student_answers.question_id', '=', 'quiz_questions.id')
                ->on('quiz_student_answers.student_id', '=', 'quiz_student_scores.student_id');
        })
        ->where('quiz_student_scores.quiz_id', $quizz_id)
        ->groupBy(
            'quiz_student_scores.id',
            'quiz_student_scores.student_id',
            'quiz_student_scores.quiz_id'
        )
        ->get();
    
        return view('Quizizz.Studentquiz.quizzReports',compact('quiz','data'));
    }
    

    
}
