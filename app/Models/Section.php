<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class)->orderBy('id', 'asc');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('user_id', 'section_id');
    }

    public static function allSections()
    {
        return Self::all();
    }

    public function setFields($req)
    {
        $this->course_id = $req->course;
        $this->name = $req->name;
        return $this;
    }

    public function updateEnrollmentCount()
    {
        $this->enrollment_count = $this->enrollment_count + 1;
        return $this;
    }

    public static function getSectionNameById($id)
    {
        return Section::find($id)->name;
    }
}
