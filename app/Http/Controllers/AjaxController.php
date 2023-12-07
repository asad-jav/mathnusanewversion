<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Grade;
use Carbon\Carbon;
class AjaxController extends Controller
{
    public function gradeCourses($grade_id)
    {
        $data['grade'] = Grade::find($grade_id);
        $data['courses'] = Course::where('grade_id', $grade_id)
        ->whereDate('end_date', '>=', date('Y-m-d'))
        ->orderBy('id', 'asc')
        ->get();
        return view('landing-page.ajax.allCourses', $data);
    }

    public function updateCourseStatus(Request $req)
    {
        $course = Course::find($req->course_id);
        $course->status = $req->status;
        if($course->update()){
            return ['code' => 101, 'message' => "Status changed successfully"];
        } else {
            return ['code' => 102, 'message' => "Status has not been updated"];
        }
    }
}
