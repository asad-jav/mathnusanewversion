<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $table = 'instructors';
    const ADMIN_PREFERRED = 1;
    const SELF_REGISTER = 2;

    const APPROVED = 1;
    const DISAPPROVED = 0;
    const BLOCKED = 2;

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public static function getInstructors()
    {
        return Instructor::orderBy('id', 'desc')->paginate(20);
    }
}
