<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index(){
        $grades = Grade::orderBy('number','asc')->get();
        return view('admin.grades.index',compact('grades'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'number' => 'required|integer',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade created successfully.');
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'name' => 'required|string',
            'number' => 'required|integer',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }

    public function destroy($id)
    {
        $grade = Grade::find($id);
        
        if (!$grade) {
            return response()->json(['success' => false]);
        }

        $grade->delete();

        return response()->json(['success' => true]);
    }
}
