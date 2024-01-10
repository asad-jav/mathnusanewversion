<?php

namespace App\Http\Controllers\Quizizz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Grade;
use App\Models\CourseUser;
use App\Models\Quizizz;
use App\Models\QuizQuestion;
use App\Models\QuizStudentAnswer;
use App\Models\QuizStudentScore;
use App\Models\Standard;
use DataTables;
use Faker\Provider\ar_EG\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class QuizizzController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->isInstructor() || Auth::user()->isAdmin()){
            if(Auth::check() && Auth::user()->isInstructor()) 
            {
                $courses = Auth::user()->courses; 
                $subcorses = $courses->pluck('id')->toArray(); 
                if ($request->ajax()) {
                
                    $data = Quizizz::with('course')->whereIn('course_id',$subcorses)->select('*'); 
                }
            } 
            else 
            {
                $courses = Course::all();
                if ($request->ajax())
                {
                    $data = Quizizz::with('course')->select('*'); 
                }
            }

            if ($request->ajax()) 
            {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                        $btn = $btn.' <a href='.route("quizizz.show","$row->id").' data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="view" title="view" class="btn btn-sm btn-primary"><i class="ft-eye"></i></a>';
                        
                        $url1 = url('student/quizizz/view',$row->id);
                        $btn = $btn.' <a href="'.$url1.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Students Quizizz"  title="Students Quizizz"  class="btn btn-sm btn-secondary"><i class="ft-users"></i> </a>';
                
                        $url = route('quizizz.edit',$row->id);
                        $btn =  $btn.' <a href="'.$url.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit"  title="Edit" class="edit editQuizizz btn btn-sm btn-success"><i class="ft-edit"></i></a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete"  title="Delete"  class=" deleteQuizizz btn btn-sm btn-danger"><i class="ft-trash"></i> </a>';
                        $btn = $btn.'</div>';
                        return $btn;
                })->addColumn('course', function ($row) {
                    
                        return $row->course->title;
            
                })->addColumn('status', function ($row) {
                    if($row->status == 0){
                        $status = '<span class="badge badge-danger">Disable</span>';
                    }else if($row->status == 1){
                        $status = '<span class="badge badge-success">Enable</span>';
                    }else if($row->status == 2){
                        $status = '<span class="badge badge-primary">Complete</span>';
                    }
                    return $status;
        
                })
                ->rawColumns(['action','status'])
                ->make(true);
            } 
            $grades = Grade::all();
            return view('quizizz.quizizz.index',compact('courses','grades'));
        }else{
            return back()->with(['status' => 'failure','message' => "you don't have access of this page"]);
        }
    }

    public function create(){
        $grades = Grade::all();
        return view('quizizz.quizizz.create',compact('grades'));
    }

    public function get_grade_courses(Request $request)
    {
        $id = $request->grade;
        if(Auth::check() && Auth::user()->isInstructor()) 
        {
            $courses = Auth::user()->courses; 
        }else{
            $courses = Course::where('grade_id',$id)->get();
        }
        $standards = Standard::where('grade_id',$id)->get();
        
            return response()->json(['courses'=>$courses,'standards'=> $standards]);
       
    }

    public function get_standard_detail(Request $request){
        $id = $request->standards;
        $standard = Standard::where('id',$id)->first(); 
            return response()->json(['status' => 'success','standard'=> $standard]);
       
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'grade' => 'required',
            'course' => 'required',
            'start_date' => 'required',
            'standards' => 'required',
            'end_date' => 'required',
            'passing_marks' => 'required'
        ]);
       
        Quizizz::Create([
            'title' => $request->title, 
            'course_id' => $request->course,
            'standard_id' => $request->standards,
            'grade_id' => $request->grade,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => '0',
            'description' => $request->description,
            'passing_marks' => $request->passing_marks,

        ]);        
        return redirect('quizizz')->with(['status' => 'success','message'=>'Quizizz saved successfully.']);
    }

    public function update(Request $request,$id)
    { 
        $this->validate($request,[
            'title' => 'required',
            'grade' => 'required',
            'standards' => 'required',
            'course' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'passing_marks' => 'required'
        ]);
        $quiz = Quizizz::where('id',$id)->first();  
        if($request->status == '1' || $request->status == '2')
        {
            if ($quiz->easy_level >= 9 && $quiz->average_level >= 9 && $quiz->difficult_level >= 9 && $quiz->very_difficult_level >= 9 && $quiz->total_questions >= 36)
            { 
                $quiz->status = $request->status;
            }
            else
            { 
                return back()->with(['status' => 'failure','message' => 'Quiz questions must be greater then 36 and each difficulty level must have 9 questions.']);
            }
        }else{
            $quiz->status = $request->status;
        }

        $quiz->title = $request->title;
        $quiz->course_id = $request->course;
        $quiz->grade_id = $request->grade;
        $quiz->standard_id = $request->standards;
        $quiz->start_date = $request->start_date;
        $quiz->end_date = $request->end_date;
        $quiz->description = $request->description;
        $quiz->passing_marks = $request->passing_marks;
        $quiz->update();
        return redirect('quizizz')->with(['status' => 'success','message'=>'Quizizz updated successfully.']);
             
    }

    public function show($id)
    {
        $quiz = Quizizz::find($id); 
        $questions = QuizQuestion::where('quiz_id',$id)->get();
        $all_questions =  QuizQuestion::where('quiz_id','!=',$id)->OrderBy('id','desc')->get();
        return view('quizizz.quizizz_questions.index',compact('quiz','questions','all_questions'));
    }

    public function edit($id){
        $quiz = Quizizz::find($id);
        $grades = Grade::all();
        
        $courses = Course::where('grade_id',$quiz->grade_id)->get();
        $standards = Standard::where('grade_id',$quiz->grade_id)->get();
        return view('quizizz.quizizz.edit',compact('grades','quiz','courses','standards'));
    }

    public function destroy($id)
    {
        Quizizz::find($id)->delete();
        return response()->json(['success'=>'Quizizz deleted successfully.']);
    }

    public function import_questions(Request $request)
    {
        $quizId = $request->quiz_id;
        $questionIds = $request->input('questions');
        $questionId = explode(',',$questionIds);
        foreach($questionId as $qid)
        {
            $quiz = Quizizz::where('id', $quizId)->first();
            $question = QuizQuestion::where('id',$qid)->first();
            if($question)
            {
                if ($quiz) 
                {
                    $quiz->increment('total_questions', 1);
                    if ($question->difficulty_level == '1') {
                        $quiz->increment('easy_level', 1);
                    } elseif ($question->difficulty_level == '2') {
                        $quiz->increment('average_level', 1);
                    } elseif ($question->difficulty_level == '3') {
                        $quiz->increment('difficult_level', 1);
                    } elseif ($question->difficulty_level == '4') {
                        $quiz->increment('very_difficult_level', 1);
                    }
                    $quiz->save();
                }
                $newQuestion = new QuizQuestion();
                $newQuestion->create([
                    'quiz_id' =>  $quizId,
                    'question' => $question->question,
                    'question_type' => $question->question_type,
                    'difficulty_level' => $question->difficulty_level,
                    'choices' => $question->choices,
                    'answer' => $question->answer,
                    'video_link' => $question->video_link,
                    'image_link' => $question->image_link,
                    'audio_link' => $question->audio_link,
                    'points' => $question->points,
                ]);
            }
            
        }
        return back()->with('success','Question Imported Successfully');
    }

    public function studentQuizizz($id){ 
        $quiz = Quizizz::where('id',$id)->first(); 
        $quizizz = QuizStudentScore::with('quiz','student','student_answers')->where('quiz_id',$id)->get(); 
        return view('quizizz.quizizz.studentQuiz',Compact('quizizz','quiz'));
    }

    public function studentQuizizzAnswer($quiz_id,$student_id){ 
        $quizizz = QuizStudentScore::with('student')->where('id',$quiz_id)->where('student_id',$student_id)->first(); 
        $answers = QuizStudentAnswer::with('question')->where('quiz_student_score_id',$quiz_id)->where('student_id',$student_id)->get(); 
        return view('quizizz.quizizz.studentQuizAnswer',compact('quizizz','answers'));
    }
}
