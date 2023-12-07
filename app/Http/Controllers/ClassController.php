<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Message;
use App\Models\Praise;
use App\Models\User;
use App\Models\WhiteboardLecture;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class ClassController extends Controller
{
    public function index($lecture_id)
    {
        $lecture = Lecture::find($lecture_id);
        $course_id = $lecture->course->id;
        $lectureTime = Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone(Auth::user()->timezone);
      
        $isPast = $lectureTime->addMinutes($lecture->duration*60)->isPast();
        $data = Lecture::verifyAndRenderClass($lecture_id);    
        if(Auth::user()->isStudent()) {
            if(Auth::user()->courses->contains($course_id)){
                if($isPast){ 
                    return view('classes.index', $data);
                } else {
                    if($lecture->state == 1){
                        Auth::user()->markAsAttended($lecture->id);  
                        return view('classes.index', $data);
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
                return view('classes.index', $data);
            } else {
                return redirect('admin/dashboard')->with('failure', __('messages.Lecture not found'));
            }
        } else if(Auth::user()->isInstructor()) {
            if(Auth::user()->courses->contains($course_id)){
                if(Lecture::where('id', $lecture_id)->exists()) {
                    Auth::user()->markAsAttended($lecture->id);
                    return view('classes.index', $data);
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

    public function getMessages(Request $req, $id)
    {
        Message::where("channel", $req->channel)->update(['is_read' => 1]);
        $lecture = Lecture::find($req->lecture);
        $data['messages'] = Message::where("channel", $req->channel)->orderBy('id', 'asc')->get();
        $data['praises'] = Praise::where('user_id',Auth::id())->get();
        $data['channel'] = $req->channel;
        $data['lecture'] = $lecture;
        
        return view('classes.chat', $data);
    }

    public function sendMessage(Request $req, Pusher $pusher){
        $from = Auth::id();
        $role = Auth::user()->role_id;
        $from_name = Auth::user()->first_name.' '.Auth::user()->last_name;
        $to = $req->receiver_id;
        $message = $req->message;
        $lecture_id = $req->lecture_id;
        $event = 'my-event';

        $type = 0;
        if($req->type == 'private'){
            $type = 1;
        } else if($req->type == 'channel') {
            $type = 2;
        }
        $channel = $req->channel;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->type = $type;
        $data->message = $message;
        $data->channel = $channel;
        $data->is_read = 0;
        $data->lecture_id = $lecture_id;
        $data->message_type = 1; //1 for text message
        $data->save();

        $created_date = date("Y-m-d H:i:s", strtotime($data->created_at));
        $avatar = !empty(Auth::user()->avatar) ? View::make('components.profile-image')->render() : View::make('components.profile-image-initials')->render();
        if(Auth::user()->isAdmin()){
            $isInstructor = 'admin';
        } else if(Auth::user()->isInstructor()){
            $isInstructor = 'instructor';
        } else{
            $isInstructor = '';
        }
      
        $data = [
            'from' => $from, 
            'to' => $to, 
            'msg' => $message, 
            'date' => $created_date, 
            'type' => $req->type,
            'from_name' => $from_name,
            'channel' => $channel,
            'avatar'=> $avatar,
            'isInstructor' => $isInstructor
        ];
        $pusher->trigger($channel, $channel, $data);
        return response()->json($data);
    }

    public function fileUpload(Request $req, Pusher $pusher) {

        $from_name = Auth::user()->first_name.' '.Auth::user()->last_name;

        $random_string = Str::random(6);

        if(!file_exists('./public/files/'.$req->channel)) {
            mkdir('./public/files/'.$req->channel);
            mkdir('./public/files/'.$req->channel.'/thumbnail');
            mkdir('./public/files/'.$req->channel.'/original');
        }

        $thumbnail = Image::make($req->file('file'));
        $thumbnail->fit(300, 200);
        $thumbnail->save(public_path('files/'.$req->channel.'/thumbnail/'.$req->channel.'-'.date('Y-m-d-').$random_string.'.jpg'));

        $original = Image::make($req->file('file'));
        $original->save(public_path('files/'.$req->channel.'/original/'.$req->channel.'-'.date('Y-m-d-').$random_string.'.jpg'));

        $data = new Message();
        $data->from = Auth::id();
        $data->type = 2;
        $data->message = 'file shared';
        $data->file = 'files/'.$req->channel.'/original/'.$req->channel.date('-Y-m-d-').$random_string.'.jpg';
        $data->thumbnail = 'files/'.$req->channel.'/thumbnail/'.$req->channel.date('-Y-m-d-').$random_string.'.jpg';
        $data->channel = $req->channel;
        $data->is_read = 0;
        $data->lecture_id = $req->lecture_id;
        $data->message_type = 0; //0 for file sharing
        $data->save();

        $created_date = date("Y-m-d H:i:s", strtotime($data->created_at));

        $img = View::make('components.chatImgTag', compact('data'))->render();
        $avatar = !empty(Auth::user()->avatar) ? View::make('components.profile-image')->render() : View::make('components.profile-image-initials')->render();

        $data = [
            'from' => Auth::id(),
            'to' => 0, 
            'msg' => $img, 
            'date' => $created_date, 
            'type' => 'channel', 
            'from_name' => $from_name,
            'channel' => $req->channel,
            'avatar'=> $avatar,
            'isInstructor' => Auth::user()->isAdmin()
        ];

        $pusher->trigger($req->channel, $req->channel, $data);
        return response()->json($data);
    }

    public function lectureState(Request $req, $lecture_id, Pusher $pusher)
    {
        $lecture = Lecture::find($lecture_id);
        $lecture->state = $req->state;
        // if(empty($lecture->whiteboard)){
        //     $lecture->whiteboard = 'http://localhost:3000/#room=classroom_'.$lecture_id.','.substr(md5(uniqid(mt_rand(), true)), 0, 22);
        // }
        $lecture->update();

        $data = ['lecture' => $lecture, 'lectureState' => $req->state];
        $pusher->trigger('change_lecture_state', 'my-event', $data);
    }
}
