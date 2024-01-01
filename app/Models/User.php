<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Cashier;
use Image;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;
    const ADMIN = 'admin';
    const STUDENT = 'student';
    const INSTRUCTOR = 'instructor';

    const ROLE_ADMIN = 1;
    const ROLE_STUDENT = 2;
    const ROLE_INSTRUCTOR = 3;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'contact',
        'country',
        'dob',
        'grade_id',
        'timezone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class)->withPivot('user_id', 'course_id', 'section_id', 'payment_id')->withTimestamps();
    }
    public function sections()
    {
        return $this->belongsToMany(Section::class)->withTimestamps();
    }

    public static function isEnrolled($course_id, $section_id)
    {
        $isEnrolled = DB::table('course_user')
        ->where('user_id',Auth::id())
        ->where('section_id', $section_id)
        ->where('course_id', $course_id)->first();

        return $isEnrolled;
    }

    public function userCourses()
    {
        return $this->hasMany(Course::class);
    }

    public function lectures() {
        return $this->belongsToMany(Lecture::class);
    }

    public function createdLecture()
    {
        return $this->hasMany(Lecture::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'from');
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    public function isAdmin() {
        return $this->roles[0]->slug == User::ADMIN;
    }

    public function isStudent() { 
        return $this->roles[0]->slug == User::STUDENT;
    }
    
    public function isInstructor() { 
        return $this->roles[0]->slug == User::INSTRUCTOR;
    }

    public function retrieveStripeCustomer($stripeId)
    {
        return Cashier::findBillable($stripeId);
    }

    public static function allPlansList()
    {
        // $stripe = new StripeClient(env('STRIPE_SECRET'));
        // return $stripe->plans->all(['limit' => 4, 'active' => true])->data;
        return Plan::all();
    }

    public static function isKuwait()
    {
        return Auth::user()->country == "Kuwait";
    }

    public static function countrySpecificAmount($object) //pass object as a parameter
    {
        if(Gate::allows('isKuwait')) {
            return round($object->amount_in_kwd, 0);
        } else {
            return round($object->amount_in_usd, 0);
        }
        
    }

    public static function countrySpecificSymbol()
    {
        if(Auth::check() && Auth::user()->isKuwait()) {
            return "USD";
        } else {
            return "USD";
        }
    }

    public function markAsAttended($lecture_id){
        if(!Auth::user()->lectures->contains($lecture_id))
        {
            Auth::user()->lectures()->attach($lecture_id);
        }
    }

    public static function getCurrentDateDifference($date)
    {
        $created = new Carbon($date);
        $now = Carbon::now();
        return $difference = ($created->diff($now)->days < 1)
            ? 'today'
            : $created->diffForHumans($now);
    }

    public static function getInstructors()
    {
        $role = Self::INSTRUCTOR;
        return User::whereHas('roles', function($query) use ($role) {
            $query->where('slug', $role);
        })->with('courses')->get();
    }

    public static function profileImageUpdate($files)
    {
        $random_string = Str::random(6);
        $file_name = date('Y-m-d-').$random_string.'.jpg';
        $thumbnail = Image::make($files);
        $thumbnail->fit(300, 300);
        $thumbnail->save('./public/profile_images/'.$file_name);
        return $file_name;
    }

}
