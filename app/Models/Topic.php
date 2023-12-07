<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function setColumns($req)
    {
        $this->course_id = $req->course_id;
        $this->title = $req->title;
        $this->topic_index = $req->topic_index;
        $this->unpack_standard = $req->unpack_standard;
        $this->live_sessions = $req->live_sessions;
        $this->objectives = $req->objectives;
        return $this;
    }
}
