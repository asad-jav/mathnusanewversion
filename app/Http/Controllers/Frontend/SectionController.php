<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Rating;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function courseSections($id)
    {
        $course = Course::find($id); 
        $ratings = Rating::where('course_id', $id)->with('user')->get(); 
        $data['course'] = $course;
        
        $data['ratings'] = $ratings;
        return view('frontend.landing-page.section.courseSections', $data);
    }

    public function sectionsLectures($id)
    {
        $section = Section::find($id);
        $data['section'] = $section;
        $data['lectures'] = $section->lectures;
        return view('frontend.section.sectionsLectures', $data);
    }
}
