<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
class Course extends Model
{
    use HasFactory;
    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $fillable = ['number_of_lectures', 'title', 'course_outline', 'user_id'];

    public function lectures() {
        return $this->hasMany(Lecture::class);
    }

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('user_id', 'course_id', 'section_id', 'payment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    public static function getAllCourses()
    {
        return Course::all();
    }

    public static function getActiveCourses()
    {
        return Course::where('status', 1)->get();
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class);
    }

    public static function createCourse($req)
    {
        $course = new Course();
        $course->number_of_lectures = $req->number_of_lectures;
        $course->title = $req->title;
        $course->category_id = $req->category;
        $course->grade_id = $req->grade;
        $course->amount_in_usd = $req->amount_in_usd;
        $course->amount_in_kwd = $req->amount_in_kwd;
        $course->seats = $req->seats;
        $course->start_date = $req->start_date;
        $course->end_date = $req->end_date;
        $course->course_outline = $req->course_outline;
        $course->user_id = Auth::id();
        $course->image = $req->filename;
        $course->save();
        return $course;
    }

    public static function allCourses()
    {
        return DB::select("select * from courses where id not in (select course_id from course_user where user_id = ".Auth::id().")");
    }

    public static function studentCourses()
    {
        //
    }

    public static function enrolCourse($course_id)
    {
        $course = Course::find($course_id);
        // return $course->lectures;

        $lecture_count = $course->lectures->count();
        if($lecture_count != 0) {   
            for($i = 0; $i < $lecture_count; $i++){

                $lecture = $course->lectures[$i];
                $enrol_count = $lecture->enrol_count;//21
                $enrol_limit = $lecture->enrol_limit;//21

                if($enrol_count < $enrol_limit){
                    $lecture->enrol_count++;
                    if($lecture->update()) {
                        $enrol_course = DB::table('course_user')->insert([
                            'user_id' => Auth::id(),
                            'course_id' => $course_id
                        ]);
                        $lecture_user = DB::table('lecture_user')->insert([
                            'user_id' => Auth::id(),
                            'lecture_id' => $lecture->id
                        ]);
                    }
                    break;
                } 
                // else {
                //     return back()->with('danger', 'There is no capacity in the course lecture');
                // }
            }
        } else {
            return back()->with('danger', 'No lecture available for now');    
        }

        return back()->with('success', 'You have been successfully enroled with the selected course');
    }

    public static function getTopCoursesGradeWise($grade)
    {
        return Course::where('grade', $grade)->take(4)->get();
    }

    public static function getAllCoursesGradeWise($grade)
    {
        return Course::where('grade', $grade)->get();
    }

    public static function uploadCropedImage($file, $filename)
    {
        $thumbnail = Image::make($file);
        $thumbnail->fit(300, 200);
        $thumbnail->save(public_path('courses_images/'.$filename));
    }
}
