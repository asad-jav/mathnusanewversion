<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Rating;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class CourseController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->isInstructor()) {
            $data['courses'] = Auth::user()->courses; 
        } else {
            $data['courses'] = Course::all(); 
        }
        return view('course.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::allCategories();
        $data['grades'] = Grade::allGrades();

        return view('course.create', $data);
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'number_of_lectures' => 'required',
            'course_outline' => 'required',
            'grade' => 'required',
            'amount_in_usd' => 'required',
            'amount_in_kwd' => 'required',
            'category' => 'required',
            'image' => 'required|image'
        ]);

        $filename = date('dmY-').Str::random(6).'.jpg';
        $req['filename'] = $filename;
        
        $course = Course::createCourse($req);

        if($course) {
            if(Auth::user()->isInstructor()){
                Auth::user()->courses()->attach($course->id);
            }
            Course::uploadCropedImage($req->file('image'), $filename);
            return redirect(url('topic/'.$course->id))->with('success', __('messages.Course created successfully'));
        }
    }

    public function edit($id)
    {
        $data['categories'] = Category::allCategories();
        $data['course'] = Course::find($id);
        $data['grades'] = Grade::allGrades();

        return view('course.edit', $data);
    }

    public function update(Request $req)
    {
        $filename = date('dmY-').Str::random(6).'.jpg';
        
        $course = Course::find($req->id);
        $course->title = $req->title;
        $course->category_id = $req->category;
        $course->grade_id = $req->grade;
        $course->amount_in_usd = $req->amount_in_usd;
        $course->amount_in_kwd = $req->amount_in_kwd;
        $course->seats = $req->seats;
        $course->start_date = $req->start_date;
        $course->end_date = $req->end_date;
        $course->number_of_lectures = $req->number_of_lectures;
        $course->course_outline = $req->course_outline;
        if($req->has('image')){
            $course->image = $filename;
            Course::uploadCropedImage($req->file('image'), $filename);
        }

        if($course->update()) {
            return back()->with('success', __('messages.Course updated successfully'));
        }
    }

    public function delete($id)
    {
        $course = Course::find($id);
        if($course->delete()) {
            return back()->with('success', __('messages.Course has deleted successfully'));
        }
    }

    public function courseLectures($course_id)
    {
        $course = Course::find($course_id);
        $data['lectures'] = $course->lectures;
        $data['course_title'] = $course->title;
        return view('lecture.courseLecture', $data);
    }

    public function gradeCourses($id)
    {
        return Course::where('grade', $id)->take(4)->with('category')->get();
    }

    public function fetchCourseTopics($id)
    {
        $topics = Course::find($id)->topics;
        $list = '';
        foreach($topics as $topic){
            $list .= '<option value="'.$topic->id.'">'.$topic->title.'</option>';
        }

        return ['message' => 'success','data' => $list];
    }

    public function fetchCourseSections(Request $req)
    {
        if($req->has('courses')){
            $data['user_id'] = $req->user_id;
            $data['courses'] = Course::whereIn('id',$req->courses)->with('sections')->get();
            return view('ajax.courseSections', $data);
        } else {
            return [];
        }   
    }

    public function fetchCourseSectionsForInstructor($id)
    {
        $sections = Course::find($id)->sections;
        $list = '';
        foreach($sections as $section){
            $list .= '<option value="'.$section->id.'">'.$section->name.'</option>';
        }

        return ['message' => 'success','data' => $list];
    }

    public function rateCourse(Request $request, $courseId)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $rating = new Rating([
            'course_id' => $courseId,
            'user_id' => auth()->id(),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);
        $rating->save();

        return response()->json(['success' => 'Rating and comment submitted successfully']);
    }
}
