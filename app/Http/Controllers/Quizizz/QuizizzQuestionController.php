<?php

namespace App\Http\Controllers\Quizizz;

use App\Http\Controllers\Controller;
use App\Models\Quizizz;
use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class QuizizzQuestionController extends Controller
{
    public function create($quizz_id)
    {
        return view('quizizz.quizizz_questions.create',compact('quizz_id'));
    }

    public function store(Request $request) 
    {
        $this->validate($request,[
            'quesiton' => 'required',
            'question_type' => 'required',
            'difficulty_level' => 'required',
            'points' => 'required',
        ]);
        
        $answer = '';
        $choices =  '';
        if($request->question_type == 1){
            $answer = $request->identification;
        }else if($request->question_type == 2){
            $answer = $request->mcq[$request->correctchoice];
            $choices =   implode(';', $request->mcq);
        }else if($request->question_type == 3){
            $answer = $request->truefalse; 
        }
        if($request->image){ 
            $random_string = time(); 
            $image = Image::make($request->file('image'));
            $image->resize(300, 300);
            $image->save('./public/questionImage/'.$random_string.'.jpg'); 
            $image_url = 'public/questionImage/'.$random_string.'.jpg';
        }

        QuizQuestion::create([
            'quiz_id'       => $request->quiz_id,
            'question'      => $request->quesiton,
            'question_type' => $request->question_type,
            'image_link'    => $image_url ?? '',
            'video_link'    => $request->video_links ?? '',
            'answer'        => $answer,
            'points'        => $request->points ?? 1,
            'choices'       => $choices ?? '',
            'difficulty_level' => $request->difficulty_level,
        ]);
        $quiz = Quizizz::where('id', $request->quiz_id)->first();
        if ($quiz) 
        {
            $quiz->increment('total_questions', 1);
            if ($request->difficulty_level == '1') {
                $quiz->increment('easy_level', 1);
            } elseif ($request->difficulty_level == '2') {
                $quiz->increment('average_level', 1);
            } elseif ($request->difficulty_level == '3') {
                $quiz->increment('difficult_level', 1);
            } elseif ($request->difficulty_level == '4') {
                $quiz->increment('very_difficult_level', 1);
            }
            $quiz->save();
        }

        else
        {
            return back()->with('error','Something went wrong!');
        }
        return redirect('quizizz/'.$request->quiz_id)->with('success', __('QuizQuestion created successfully')); 
    }

    
    public function edit($id) { 
        $question = QuizQuestion::find($id);
        return view('quizizz.quizizz_questions.edit',compact('question'));
    }

    public function update(Request $request,$id) { 
        $answer = '';
        $choices =  '';
        
        $question  = QuizQuestion::where('id',$id)->first();
        if($request->question_type == 1){
            $answer = $request->identification;
            $choices = '';
        }else if($request->question_type == 2){
            $answer = $request->mcq[$request->correctchoice];
            $choices =   implode(';', $request->mcq);
        }else if($request->question_type == 3){
            $answer = $request->truefalse; 
            $choices = '';
        }
        if($request->image){ 
            if(File::exists($question->image_link)) {
                File::delete($question->image_link);
            }
            $random_string = time(); 
            $image = Image::make($request->file('image'));
            $image->resize(300, 300);
            $image->save('./public/questionImage/'.$random_string.'.jpg'); 
            $image_url = 'public/questionImage/'.$random_string.'.jpg';
        }
        QuizQuestion::where('id',$id)->update([
            'quiz_id'       => $request->quiz_id,
            'question'      => $request->quesiton,
            'question_type' => $request->question_type,
            'image_link'    => $image_url ?? $question->image_link,
            'video_link'    => $request->video_links ?? $question->video_links,
            'answer'        => $answer,
            'points'        => $request->points ?? 1,
            'choices'       => $choices ?? '',
            'difficulty_level' => $request->difficulty_level,
        ]); 
        return redirect('quizizz/'.$request->quiz_id)->with('success', __('QuizQuestion updated successfully')); 
    }

    public function destroy($id){
        $question  = QuizQuestion::where('id',$id)->first();
        $quiz_id = $question->quiz_id;
        $quiz = Quizizz::where('id', $quiz_id)->first();
        if ($quiz) 
        {
            $quiz->decrement('total_questions', 1);
            if ($question->difficulty_level == '1') {
                $quiz->decrement('easy_level', 1);
            } elseif ($question->difficulty_level == '2') {
                $quiz->decrement('average_level', 1);
            } elseif ($question->difficulty_level == '3') {
                $quiz->decrement('difficult_level', 1);
            } elseif ($question->difficulty_level == '4') {
                $quiz->decrement('very_difficult_level', 1);
            }
            $quiz->save();
        }
        if(File::exists($question->image_link)) {
            File::delete($question->image_link);
        }
        $question->delete();
        return redirect('quizizz/'.$quiz_id)->with('success', __('QuizQuestion deleted successfully')); 
    }
}
