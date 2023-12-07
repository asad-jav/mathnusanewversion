<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;

class LectureController extends Controller
{
    public function index()
    {
        if(Auth::user()->isInstructor()){
            $sections = Auth::user()->sections;
            foreach($sections as $section){
                $lectures[] = $section->lectures;
            }
            if(!empty($lectures)){
                $data['lectures'] = $lectures[0];
            } else {
                $data['lectures'] = [];
            }
        } else {
            $data['lectures'] = Lecture::all();
        }
        
        return view('lecture.index', $data);
    }

    public function create()
    {
        $data['courses'] = Course::all();
        return view('lecture.create', $data);
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'outline' => 'required',
            'duration' => 'required',
            'datetime' => 'required',
            'course_id' => 'required',
            'lecture_number' => 'required',
            'start_time' => 'required',
            'topic' => 'required',
            'section' => 'required',
        ]);

        $lecture = new Lecture();
        $lecture->createLecture($req); 
        $lecture->save();
        return back()->with('success', __('messages.Lecture created successfully'));
    }

    public function edit($id)
    {
        $data['courses'] = Course::all();
        $data['lecture'] = Lecture::find($id);
        return view('lecture.edit', $data);
    }

    public function update(Request $req)
    {
        $lecture = Lecture::find($req->id);
        $lecture->title = $req->title;
        $lecture->outline = $req->outline;
        $lecture->duration = $req->duration;
        $lecture->datetime = $req->datetime;
        $lecture->course_id = $req->course_id;
        $lecture->start_time = $req->start_time;
        $lecture->section_id = $req->section;
        $lecture->topic_id = $req->topic;

        if($lecture->update()) {
            return back()->with('success', __('messages.Lecture updated successfully'));
        }
    }

    public function delete($id)
    {
        $lecture = Lecture::find($id);
        if($lecture->delete()) {
            return back()->with('success', __('messages.Lecture has deleted successfully'));
        }
    }
}
