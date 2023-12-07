<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{
    public function index(){
        $standards = Standard::get();
        $grades = Grade::get();
        return view('admin.standards.index',compact('standards','grades'));
    }
    public function create(){
        $standards = Standard::get();
        $grades = Grade::get();
        return view('admin.standards.create',compact('standards','grades')); 
    }
    public function store(Request $request){ 
        $request->validate([
            'grades' => 'required',
            'title' => 'required',
        ]);

        $standards              = new Standard();
        $standards->grade_id    = $request->grades;
        $standards->parent_id   = $request->main_standard;
        $standards->title       = $request->title;
        $standards->description = $request->description;
        $standards->save();

        return redirect()->route('standards.index')->with('success', 'Standard created successfully.');
    }

    public function edit($id){
        $standard = Standard::find($id);
        $standards = Standard::get();
        $grades = Grade::get();
        return view('admin.standards.edit',compact('standard','standards','grades'));
    }

    public function update(Request $request,$id){ 
        $request->validate([
            'grades' => 'required',
            'title' => 'required',
        ]);

        $standards              = Standard::find($id);
        $standards->grade_id    = $request->grades;
        $standards->parent_id   = $request->main_standard;
        $standards->title       = $request->title;
        $standards->description = $request->description;
        $standards->update();

        return redirect()->route('standards.index')->with('success', 'Standard updated successfully.');
    }

    public function destroy($id)
    {
        $standard = Standard::find($id);
        
        if (!$standard) {
            return response()->json(['success' => false]);
        }

        $standard->delete();

        return response()->json(['success' => true]);
    }
}
