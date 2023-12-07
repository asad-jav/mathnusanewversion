<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index(){
        
        if(Auth::user()->isInstructor()){
            $data['sections'] = Auth::user()->sections;
        } else {
            $data['sections'] = Section::allSections();
        }
        return view('section.index', $data);
    }

    public function create()
    {
        if(Auth::user()->isInstructor()){
            $data['courses'] = Auth::user()->courses;
        } else {
            $data['courses'] = Course::allCourses();
        }

        return view('section.create', $data);
    }

    public function store(Request $req){
        
        $req->validate([
            'course' => 'required',
            'name' => 'required'
        ]);

        $check_section = Section::where('course_id', $req->course)->where('name', $req->name)->get();
        if(!$check_section->isEmpty()){
            $array = [
                'error' => 'This section name is already used for selected course',
                'course' => $req->course,
                'name' => $req->name
            ];
            return back()->with($array);
        }

        $section = new Section();
        $section->setFields($req);

        if($section->save()){
            if(Auth::user()->isInstructor()){
                Auth::user()->sections()->attach($section->id);
            }
            // return back()->with('success', 'Section updated successfully');
            return redirect()->route('lecture.create')->with('success', 'Section Created successfully');
        } else {
            return back()->with('failure', 'Data not update record');
        }
    }

    public function edit($id)
    {
        $data['courses'] = Course::allCourses();
        $data['section'] = Section::find($id);
        return view('section.edit', $data);
    }

    public function update(Request $req)
    {
        $req->validate([
            'course' => 'required',
            'name' => 'required'
        ]);

        $section = Section::find($req->id);
        $section->setFields($req);

        if($section->update()){
            return back()->with('success', 'Section updated successfully');
        } else {
            return back()->with('failure', 'Data not update record');
        }
    }

    public function delete($id)
    {
        if(Section::find($id)->delete()){
            return back()->with('success', 'Section deleted successfully');
        } else {
            return back()->with('failure', 'Data not delete from the database');
        }
    }

    public function courseSections($id)
    {
        $course = Course::find($id);
        $data['course'] = $course;
        return view('landing-page.section.courseSections', $data);
    }

    public function sectionsLectures($id)
    {
        $section = Section::find($id);
        $data['section'] = $section;
        $data['lectures'] = $section->lectures;
        return view('section.sectionsLectures', $data);
    }
}
