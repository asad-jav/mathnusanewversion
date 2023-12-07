<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Role;
use App\Models\Section;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $data['videos'] = Video::orderBy('id', 'desc')->take(3)->get();
        $data['enrolled_courses'] = Auth::user()->courses;
        $data['attended_lectures'] = Auth::user()->lectures;
        $data['total_lectures'] = Lecture::studentsAllLectures();
        // return $data['today_lectures'] = Lecture::todayLectures();
        $data['missed_lectures'] = Lecture::missedLectures();
        return view('student.dashboard', $data);
    }

    public function courseList()
    {
        $data['courses'] = Course::allCourses();
        return view('student.courseList', $data);
    }

    public function enrollCourse($course_id)
    {
        return Course::enrolCourse($course_id);
    }
    
    public function enrolledCourses()
    {
        $data['courses'] = Auth::user()->courses;
        return view('student.enroledCourse', $data);
    }

    public function studentCourseLecture(Request $req)
    {
        if(Auth::user()->courses->contains($req->course_id)){
            $section = Section::find($req->section_id);
            $data['section'] = $section;
            $data['lectures'] = $section->lectures;
            $data['course'] = $section->course;
            return view('lecture.studentCourseLecture', $data);
        }
        return redirect('student/dashboard')->with('failure', 'You are not enrolled with this course. Please enroll first to join the lecture. Thanks');
    }

    //students crud

    public function getAllStudents()
    {
        $data['roles'] = Role::where('slug', 'student')->with('users')->get();
        return view('student.index', $data);
    }

    public function editStudent($student_id)
    {
        $data['student'] = User::find($student_id);
        return view('student.edit', $data);
    }

    public function updateStudent(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string |max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required',
            'contact' => 'required',
            'country' => 'required',
            'dob' => 'required',
            'grade' => 'required',
            'timezone' => 'required',
            'coins' => 'required',
        ]);

        $student = User::find($request->id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->grade = $request->grade;
        $student->gender = $request->gender;
        $student->country = $request->country;
        $student->contact = $request->contact;
        $student->dob = $request->dob;
        $student->timezone = $request->timezone;
        $student->coins = $request->coins;
        if($student->update()) {
            return back()->with('success', __('messages.Student record updated successfully'));
        }
    }

    public function deleteStudent($student_id)
    {
        $student = User::find($student_id);
        if($student->delete()) {
            return back()->with('danger', __('messages.Student record deleted successfully'));
        }
    }

    public function studentCourses($student_id)
    {
        $data['courses'] = User::find($student_id)->courses;
        return view('course.index', $data);
    }
}
