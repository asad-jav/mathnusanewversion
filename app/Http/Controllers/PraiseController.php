<?php

namespace App\Http\Controllers;

use App\Models\Praise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PraiseController extends Controller
{
    public function create() {
        return view('praise.create');
    }

    public function index() {
        $praises = Praise::where('user_id',Auth::id())->get();
        return view('praise.index', compact('praises'));
    }

    public function store(Request $req) {
        $req->validate([
            'msg' => 'required'
        ]);

        $praise = new Praise();
        $praise->user_id = Auth::id();
        $praise->msg = $req->msg;

        if($praise->save()) {
            return back()->with('success', __('messages.Praise message saved successfully'));
        }
        return back()->with('failure', __("messages.Could't save in database"));
    }

    public function edit($id) {
        $praise = Praise::find($id);
        return view('praise.edit', compact('praise'));
    }

    public function update(Request $req) {
        $praise = Praise::find($req->id);
        $praise->msg = $req->msg;
        if($praise->update()) {
            return back()->with('success', __('messages.Praise message updated successfully'));
        }
        return back()->with('failure', __("messages.Could't save in database"));
    }

    public function delete($id)
    {
        $praise = Praise::find($id)->delete();
        if ($praise) {
            return back()->with('failure', 'Praise deleted');
        } else {
            return back()->with('failure', __("messages.Could't delete from database"));
        }
    }
}
