<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Package;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PackagesController extends Controller
{
    public function packagesForLandingPage()
    {
        $data['plans'] = User::allPlansList();
        return view('stripe.packages', $data);
    }

    public function index()
    {
        $data['packages'] = Package::allPackages();
        return view('package.index', $data);
    }

    public function create()
    {   
        $data['grades'] = Grade::allGrades();
        $data['courses'] = Course::getAllCourses();
        return view('package.create', $data);
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'course_id' => 'required',
            'description' => 'required',
            'amount_in_usd' => 'required',
            'amount_in_kwd' => 'required',
            'image' => 'required|image',
            'grade' => 'required'
        ]);

        $filename = date('dmY-').Str::random(6).'.jpg';

        $package = new Package();
        $package->setColumns($req);
        $package->saveImage($filename);
        
        if($package->save()) {
            Package::uploadCropedImage($req->file('image'), $filename);
            $package->syncWithCourse($req->course_id);
            return back()->with('success', __('messages.Package added successfully'));
        } else {
            return back()->with('failure',  __("messages.counldn't perform this action"));
        }
    }

    public function edit($id)
    {
        $package = Package::find($id);
        $data['package'] = $package;
        $data['grades'] = Grade::allGrades();
        $data['courses'] = $package->grade->courses;
        return view('package.edit', $data);
    }

    public function update(Request $req)
    {
        // return $req->all();
        $req->validate([
            'title' => 'required',
            'course_id' => 'required',
            'description' => 'required',
            'amount_in_usd' => 'required',
            'amount_in_kwd' => 'required',
            'grade' => 'required',
        ]);

        $filename = date('dmY-').Str::random(6).'.jpg';

        $package = Package::find($req->id);
        $package->setColumns($req);

        if($req->hasFile('image')){
            $package->saveImage($filename);
            Package::uploadCropedImage($req->file('image'), $filename);
        }

        if($package->update()) {
            $package->syncWithCourse($req->course_id);
            return redirect()->route('package.edit', $req->id)->with('success', __('messages.Package updated successfully'));
        } else {
            return back()->with('failure',  __("messages.counldn't perform this action"));
        }
    }

    public function delete($id)
    {
        $package = Package::find($id);
        if($package->delete()) {
            $package->detachWithCourse();
            return back()->with('failure', __('messages.Package deleted successfully'));
        } else {
            return back()->with('failure',  __("messages.counldn't perform this action"));
        }
    }

    public function allPackages()
    {
        $data['packages'] = Package::allPackages();
        return view('landing-page.packages.allPackages', $data);
    }
}
