<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Image;
class Package extends Model
{
    use HasFactory;
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(Users::class);
    }

    public static function allPackages()
    {
        return Package::orderBy('id', 'desc')->get();
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function setColumns($req)
    {
        $this->grade_id = $req->grade;
        $this->title = $req->title;
        $this->courses_count = count($req->course_id);
        $this->description = $req->description;
        $this->amount_in_usd = $req->amount_in_usd;
        $this->amount_in_kwd = $req->amount_in_kwd;

        return $this;
    }

    public function syncWithCourse($ids)
    {
        return $this->courses()->sync($ids);
    }

    public function detachWithCourse()
    {
        return $this->courses()->detach();
    }

    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this;
    }

    public static function uploadCropedImage($file, $filename)
    {
        $thumbnail = Image::make($file);
        $thumbnail->fit(300, 200);
        $thumbnail->save(public_path('packages_images/'.$filename));
    }

    public static function totalCoursesAmount($id)
    {
        return Package::find($id)->courses->sum(function($q) {
            if(User::isKuwait()) {
                return $q->amount_in_kwd;
            } else {
                return $q->amount_in_usd;
            }
            
        });
    }
}

