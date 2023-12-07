<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Topic;

class TopicController extends Controller
{
    public function index($id)
    {
        $topics = Course::find($id)->topics;
        $course = Course::find($id);
        $data = ['topics','course'];
        return view('topics.index',compact($data));
    }

    public function create($id)
    {
        $course = Course::find($id);
        return view('topics.create', compact('course'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'topic_index' => 'required',
            'unpack_standard' => 'required',
            'live_sessions' => 'required|numeric',
            'objectives' => 'required',
        ]);

        $topic = new Topic();
        $topic->setColumns($req);

        if($topic->save()) {
            // return back()->with('success', __('messages.Topic added successfully'));
            return redirect()->route('sections.create')->with('success', __('messages.Topic added successfully'));
        } else {
            return back()->with('failure', __("counldn't perform this action"));
        }
    }

    public function edit($id)
    {
        $topic = Topic::find($id);
        return view('topics.edit', compact('topic'));
    }

    public function update(Request $req)
    {
        $topic = Topic::find($req->topic_id);
        $topic->setColumns($req);

        if($topic->update()) {
            return back()->with('success', __('messages.Topic updated successfully'));
        } else {
            return back()->with('failure', __("messages.counldn't perform this action"));
        }
    }

    public function delete($id)
    {
        $topic = Topic::find($id);
        if($topic->delete()) {
            return back()->with('failure', __('Topic deleted successfully'));
        } else {
            return back()->with('failure', __("messages.counldn't perform this action"));
        }
    }

    public function courseTopics($id)
    {
        $course = Course::find($id);
        // $data['course'] = $course;
        return view('landing-page.course.courseTopics',compact('course'));
    }
}
