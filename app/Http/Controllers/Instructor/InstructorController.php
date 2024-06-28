<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecture;
use App\Mail\InstructorInvitation;
use App\Models\User;
use App\Models\Section;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function index()
    {
        $data['instructors'] = User::getInstructors();
        $data['courses'] = Course::allCourses();
        return view('instructor.index', $data);
    }

    public function store(Request $req)
    {
        $req->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'dob' => 'required|date',
            'contact' => 'required',
            'country' => 'required',
            'timezone' => 'required',
            'school' => 'required',
            'file' => 'required|max:20000',
        ]);

        $generate_pass = Str::random(6);
        $user = new User();
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->email = $req->email;
        $user->password = Hash::make($generate_pass);
        $user->role_id = User::ROLE_INSTRUCTOR;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->gender = $req->gender;
        $user->dob = $req->dob;
        $user->contact = $req->contact;
        $user->country = $req->country;
        $user->timezone = $req->timezone;
        $user->registration_type = $req->reg_type;
        $user->status = $req->status;
        $user->school = $req->school;
        $user->avatar2 = User::profileImageUpdate($req->file);

        if($user->save()){
            $user->roles()->attach(User::ROLE_INSTRUCTOR);
            Mail::to($req->email)->send(new InstructorInvitation($user, $generate_pass));
            return redirect()->route('admin.instructors.assign.courses.form', ['user_id'=>$user->id])->with('success', 'Instructor added successfully');
        } else {
            return back()->with('failure', 'Instructor not added successfully');
        }
    }

    public function edit($id)
    {
        $data['instructor'] = User::find($id);
        return view('instructor.edit', $data);
    }

    public function update(Request $req)
    {
        $req->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'contact' => 'required',
            'country' => 'required',
            'timezone' => 'required',
            'school' => 'required',
        ]);

        $user = User::find($req->id);
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->email = $req->email;
        $user->gender = $req->gender;
        $user->dob = $req->dob;
        $user->contact = $req->contact;
        $user->country = $req->country;
        $user->timezone = $req->timezone;
        $user->school = $req->school;

        if($req->has('file')){
            $user->avatar = User::profileImageUpdate($req->file);
        }

        if($user->save()){
            return back()->with('success', 'Instructor updated successfully');
        } else {
            return back()->with('failure', 'Instructor not updated successfully');
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        if($user->delete()){
            $user->courses()->detach();
            return back()->with('success', 'Instructor deleted successfully');
        } else {
            return back()->with('failure', 'Instructor not deleted successfully');
        }
    }

    public function login()
    {
        return view('instructor.login');
    }

    public function authenticate(Request $req)
    {
        $req->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $req->email,
            'password' => $req->password,
            'role_id' => User::ROLE_INSTRUCTOR
        ];


        if(Auth::attempt($credentials)) {
            return redirect('instructor/dashboard');
        } else {
            return back()->with('status', __('messages.credentials mismatch'));
        }
    }

    public function dashboard()
    {
        $data['videos'] = Video::orderBy('id', 'desc')->take(3)->get();
        $data['enrolled_sections'] = Auth::user()->sections;
        $data['attended_lectures'] = Auth::user()->lectures;
        $data['total_lectures'] = Lecture::studentsAllLectures();
        return View::make('instructor.dashboard',  $data);
    }

    public function assignCoursesForm(Request $req)
    {
        $data['user'] = User::find($req->user_id); 
        $data['courses'] = Course::allCourses();
        return view('instructor.assignCourses', $data);
    }

    public function assignCourses(Request $req){
        // return $req->all();
        $section_flag = false;
        foreach($req->sections as $section_id){
            $section = Section::find($section_id);
            foreach($section->users as $user){
                if($user->role_id == 3 && $user->id != $req->user_id){
                    $section_flag = true;
                    $section['user'] = $user;
                    $assigned_sections[] = $section;
                    // break;
                }
            }
        }
        if(!$section_flag){
            $user = User::find($req->user_id);
            $user->courses()->sync($req->courses);
            $user->sections()->sync($req->sections);
            return back()->with('success', 'Couses assigned successfully');
        } else {
            return back()->with('failure', 
                [
                    'message'=>'Selected course or section is already assigned to other instructor see details below:',
                    'sections'=>$assigned_sections
                ]);
        }
    }

    public function instructorCourseLecture(Request $req)
    {
        if(Auth::user()->courses->contains($req->course_id)){
            $section = Section::find($req->section_id);
            $data['section'] = $section;
            $data['lectures'] = $section->lectures;
            $data['course'] = $section->course;
            return view('instructor.instructorCourseLecture', $data);
        }
        return redirect('student/dashboard')->with('failure', 'You are not enrolled with this course. Please enroll first to join the lecture. Thanks');
    }
}
