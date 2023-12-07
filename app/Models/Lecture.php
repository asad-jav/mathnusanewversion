<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lecture extends Model
{
    use HasFactory;
    const ACTIVE = 1;
    const STARTED = 1;
    const ENDED = 0;
    
    protected $fillable = ['title','outline','duration','datetime','lecture_number'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function createLecture($req)
    {
        $this->user_id = Auth::id();
        $this->course_id = $req->course_id;
        $this->title = $req->title;
        $this->outline = $req->outline;
        // $datetime = Carbon::parse($req->datetime.' '.$req->start_time);
        // $datetime = Carbon::parse($datetime)->setTimezone('UTC');
        // dd($datetime);
        $this->duration = $req->duration;
        // $this->datetime = $datetime->format('Y-m-d');
        $this->lecture_number = $req->lecture_number;
        // $this->start_time = $datetime->format('H:m');
        $this->datetime = $req->datetime;
        $this->start_time = $req->start_time;
        $this->topic_id = $req->topic;
        $this->section_id = $req->section;

        $this->save();
        return $this;
    }

    public function setActive() {
        $this->status = Lecture::ACTIVE;
    }

    public static function getChatUsers($lecture_id)
    {
        // return User::where('id', '!=', Auth::id())->get();
        $lecture = Lecture::find($lecture_id);
        return $lecture->section->users->where('id','!=', Auth::id());
    }

    public static function verifyAndRenderClass($lecture_id)
    {
        $lecture = Lecture::find($lecture_id);
        $lectureTime = Carbon::parse($lecture->datetime.' '.$lecture->start_time)->setTimezone(Auth::user()->timezone);
        $end_date_time = $lectureTime->copy()->addMinutes($lecture->duration*60);

        $users = Lecture::getChatUsers($lecture_id);
        $start_time = $lectureTime->format('h:ia');
        $end_time = $end_date_time->format('h:ia');

        $data['lecture'] = $lecture;
        $data['users']= $users;
        $data['start_time'] = $start_time;
        $data['end_time'] = $end_time;

        return $data;
    }

    public static function studentsAllLectures()
    {
        $sections = Auth::user()->sections;
        $count = 0;
        
        foreach($sections as $section){
            foreach($section->lectures as $lecture){
                $count++;
            }
        }
        return $count;
    }

    public static function missedLectures()
    {
        // $sections = Auth::user()->sections;
        // $count = 0;
        
        // foreach($sections as $section){
        //     foreach($section->lectures as $lecture){
        //         $total_lecture[] = $lecture;
        //         $count++;
        //     }
        // }
        // // return abs($count - Auth::user()->lectures->count());
        // return $total_lecture;
        $lecture_ids = [];
        $missed_lecture = [];
        
        $lectures = Auth::user()->lectures;
        foreach($lectures as $lecture){
            $lecture_ids[] = $lecture;
        }

        $un_attended = Lecture::whereNotIn('id', $lecture_ids)->get();
        foreach($un_attended as $lec){
            if($lec->datetime < date('Y-m-d')){
                $missed_lecture[] = $lec;
            }
        }

        return abs(count($lecture_ids) - Auth::user()->lectures->count());
    }

    public static function todayLectures()
    {
        return Lecture::whereHas('section', function($q){
            $q->whereHas('users', function($u){
                $u->where('id', Auth::id());
            });
        })->get();
    }
}

