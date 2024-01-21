<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function landingPage()
    {
        $data['grades'] = Grade::allGrades();
        $data['packages'] = Package::allPackages(); 
        return view('frontend.welcome', $data);
    }

    public function allCourses($grade_id)
    {
        $grade = Grade::find($grade_id);
        $data['grade'] = $grade;
        $data['courses'] =  $grade->courses->where('end_date', '>=', date('Y-m-d'))->where('status',1);
        return view('frontend.landing-page.course.allCourses', $data);
    }

    public function packageCourses($id)
    {
        $data['package'] = Package::find($id);
        return view('frontend.landing-page.packages.packageCourses', $data);
    }
}
