<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'link', 'status', 'type','description', 'view_count'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function store($req)
    {
        $this->user_id = Auth::id();
        $this->title = $req->title;
        $this->link = $req->link;
        $this->type = $req->type;
        $this->description = $req->description;

        return $this;
    }

    public static function allVideos()
    {
        return Video::orderBy('created_at', 'desc')->paginate(10);
    }
}

