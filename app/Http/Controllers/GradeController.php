<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function gradeCourses($id)
    {
        $grades = Grade::find($id)->courses;
        $list = '';
        foreach($grades as $grade){
            $list .= '<option value="'.$grade->id.'">'.$grade->title.'</option>';
        }

        return ['message' => 'success','data' => $list];
    }
}
