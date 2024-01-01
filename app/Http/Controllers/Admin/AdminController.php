<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\Course;

class AdminController extends Controller
{
    public function login()
    {
        if(Auth::check()) 
        {
            return redirect('admin/dashboard');
        }
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 1
        ]; 
       
        if(Auth::attempt($credentials)) {
            return redirect('admin/dashboard');
        } else {
            return back()->with('status', __('messages.credentials mismatch'));
        }
    }

    public function dashboard()
    {
        $students = Role::find(User::ROLE_STUDENT)->users;
        $instructors = Role::find(User::ROLE_INSTRUCTOR)->users;
        $courses = Course::get();
        $data = ['students','instructors','courses'];
        return view('admin.dashboard',compact($data));
    }
}
