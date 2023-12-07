<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\SchoolDetail;

class SchoolController extends Controller
{
    public function create()
    {
        return view('schools.addSchool');
    }

    public function store (Request $request) 
    {
        $request->validate([
            'name' => 'required|string|unique:schools',
            'school_district' => 'required|string',
            'school_address' => 'required|string',
            'principal_name' => 'required|string',
            'principal_email' => 'required|email|unique:school_details',
            'principal_phone_no' => 'required|numeric|unique:school_details',
            'team_lead_name' => 'required|string',
            'team_lead_email' => 'required|email|unique:school_details',
            'team_lead_phone_no' => 'required|numeric|unique:school_details',
        ],[
            'name.required' => 'Required',
            'school_district.required' => 'Required',
            'school_address.required' => 'Required',
            'principal_name.required' => 'Required',
            'principal_email.required' => 'Required',
            'principal_phone_no.required' => 'Required',
            'team_lead_name.required' => 'Required',
            'team_lead_email.required' => 'Required',
            'team_lead_phone_no.required' => 'Required',
        ], [
            'team_lead_name' => 'math lead name',
            'team_lead_email' => 'math lead email',
            'team_lead_phone_no' => 'math lead phone no',
        ] );

        $school = new School();
        $school->name = $request->name;
        $school->district = $request->school_district;
        $school->address = $request->school_address;
        if($school->save()) {
            $school_details = new SchoolDetail();
            $school_details->school_id = $school->id;
            $school_details->principal_name = $request->principal_name;
            $school_details->principal_email = $request->principal_email;
            $school_details->principal_phone_no = $request->principal_phone_no;
            $school_details->team_lead_name = $request->team_lead_name;
            $school_details->team_lead_email = $request->team_lead_email;
            $school_details->team_lead_phone_no = $request->team_lead_phone_no;
            if($school_details->save()) {
                return back()->with('success', __('The form was submitted successfully'));
            } else {
                return back()->with('failure', __('Data not inserted into the database'));
            }
        }
    }
}
