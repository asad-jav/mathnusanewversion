<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $data['videos'] = Video::allVideos();
        return view('video.index', $data);
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'link' => 'required',
            'type' => 'required',
            'description' => 'required'
        ]);

        $video = new Video();
        $create = $video->store($req);
        if($create->save()) {
            return back()->with('success', __('messages.Video created successfully'));
        }
    }

    public function edit($id)
    {
        $data['video'] = Video::find($id);
        return view('video.edit',$data);
    }

    public function update(Request $req)
    {
        $video = Video::find($req->id);
        $video->store($req);
        if($video->update()) {
            return back()->with('success', __('messages.Video updated successfully'));
        }
    }

    public function delete($id)
    {
        $video = Video::find($id);
        if($video->delete()) {
            return back()->with('danger', __('messages.Video deleted successfully'));
        }
    }
}
