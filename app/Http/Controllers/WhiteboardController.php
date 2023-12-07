<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\WhiteboardLecture;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class WhiteboardController extends Controller
{
    public function whiteBoard($lecture_id,Pusher $pusher)
    {
        
        $lecture = Lecture::find($lecture_id);
        $whiteboard = WhiteboardLecture::where('lecture_id',$lecture_id)->where('role_id',1)->first();
        $course_id = $lecture->course->id;
        $lectureTime = Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone(Auth::user()->timezone);  
        $isPast = $lectureTime->addMinutes($lecture->duration*60)->isPast();
        $data = Lecture::verifyAndRenderClass($lecture_id);
        $data['whiteboard']    =   $whiteboard ; 
        $data['whiteboard_lectures'] =    WhiteboardLecture::where('lecture_id',$lecture->id)->where('role_id',2)->get();
        // dd($data);
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3){
                $whiteboard = WhiteboardLecture::updateOrCreate(
                    [    "user_id"           => Auth::user()->id, 
                        "lecture_id"        => $lecture->id,
                        "role_id"           => Auth::user()->role_id,
                    ],[
                        "user_id"           => Auth::user()->id,
                        "username"          => Auth::user()->first_name.' '.Auth::user()->last_name,
                        "lecture_id"        => $lecture->id,
                        "role_id"           => Auth::user()->role_id, 
                    ]);
                $val = [
                    "id"           => $whiteboard->id, 
                ];
                $pusher->trigger('whiteboardlecture-'.$lecture->id,'image-data', $val);
            }
        if(Auth::user()->isStudent()) {
            if(Auth::user()->courses->contains($course_id)){
                if($isPast){ 
                    return view('classes.whiteboard', $data);
                } else {
                    if($lecture->state == 1){
                        Auth::user()->markAsAttended($lecture->id);  
                        return view('classes.whiteboard', $data);
                    } else {
                        $params = [
                            'course_id' => $course_id, 
                            'section_id'=> $lecture->section->id
                        ];
                        return redirect()->route('student.course.lecture',$params)->with('warning', 'Please wait till the lecture is start');
                    }
                }
            } else {
                return redirect('student/dashboard')->with('failure', 'You are not enrolled with this course. Please enroll first to join the lecture. Thanks');
            }
        } else if(Auth::user()->isAdmin()) {
            if(Lecture::where('id', $lecture_id)->exists()) {
                return view('classes.whiteboard', $data);
            } else {
                return redirect('admin/dashboard')->with('failure', __('messages.Lecture not found'));
            }
        } else if(Auth::user()->isInstructor()) {
            if(Auth::user()->courses->contains($course_id)){
                if(Lecture::where('id', $lecture_id)->exists()) {
                    Auth::user()->markAsAttended($lecture->id);
                    return view('classes.whiteboard', $data);
                } else {
                    return redirect('instructor/dashboard')->with('failure', __('messages.Lecture not found'));
                }
            } else {
                return redirect('instructor/dashboard')->with('failure', 'This lecture is not assigned to you');
            }
        } else {
            return redirect('student/dashboard')->with('failure', __('messages.not enrolled'));
        }
    }

    public function saveWhiteBoard(Request $request, Pusher $pusher){
       
        $whiteboard = WhiteboardLecture::updateOrCreate(
                        [   'user_id'    => $request->user_id,
                            'lecture_id' => $request->lecture_id  
                        ],[
                            "user_id"           => $request->user_id,
                            "username"          => $request->username,
                            "lecture_id"        => $request->lecture_id,
                            "role_id"           => $request->role_id,
                            "whiteboard_data"   => $request->whiteboard_data,
                            "data_image"        => $request->data_image,
                        ]);
        $data = [
            "id"           => $whiteboard->id, 
        ];
        $pusher->trigger('whiteboardlecture-'.$request->lecture_id,'image-data', $data);
        return Response(['status' => 'success', 'data' => $whiteboard]);
    }

    public function getWhiteBoardData(Request $request){ 
        $whiteboard = WhiteboardLecture::find($request->whiteboard_id);
        if($whiteboard){
            return Response(['status' => 'success' , 'data' => $whiteboard]);
        }else{
            return Response(['status' => 'failure']);
        }
    }
}
