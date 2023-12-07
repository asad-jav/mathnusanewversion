<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $data['grades'] = Grade::allGrades();
        return view('profile.index', $data);
    }

    public function updateProfile(Request $req)
    {
        // return $req->all();
        $validate_array = [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'contact' => 'required',
            'dob' => 'required',
            'timezone' => 'required',
        ];

        $grade_validate = ['grade' => 'required'];

        if(Auth::user()->roles->contains(User::ROLE_STUDENT)) {
            $validate_array = array_merge($validate_array, $grade_validate);
        }

        $req->validate($validate_array);

        $user = User::find(Auth::id());
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->gender = $req->gender;
        $user->country = $req->country;
        $user->contact = $req->contact;
        $user->dob = $req->dob;
        
        if(!Auth::user()->roles->contains(User::ROLE_ADMIN)){
            $user->grade_id = $req->grade;
        }
        
        $user->timezone = $req->timezone;
        if ($user->update()) {
            return back()->with('success', __('messages.Profile Updated Successfully'));
        }
        
    }

    public function changePassword()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $req)
    {
        $req->validate([
            'previous_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $hash_chakc = Hash::check($req->previous_password, Auth::user()->password);
        if($hash_chakc) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($req->password);
            $user->update();
            return back()->with('success', __('messages.Your password updated successfully'));
        } else {
            return back()->with('previous_password', __('messages.Previous password does not match'));
        }
    }

    public function uploadProfileImage(Request $req)
    {
        $random_string = Str::random(6);
        $thumbnail = Image::make($req->file('file'));
        $thumbnail->fit(300, 300);
        $thumbnail->save('./profile_images/'.date('Y-m-d-').$random_string.'.jpg');
        $user = User::find(Auth::id());
        $user->avatar = date('Y-m-d-').$random_string.'.jpg';
        $user->update();
    }
}
