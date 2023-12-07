<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function courseSections($id)
    {
        $course = Course::find($id);
        $data['course'] = $course;
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
