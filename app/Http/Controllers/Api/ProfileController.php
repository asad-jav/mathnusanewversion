<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function user_profile(Request $request)
    {
        $user = Auth::user();
        if($user)
        {
            return $this->sendResponse($user, 'User Found.');
        }
        else
        { 
            return $this->sendError('User Not Found',[],400); 
        }
    }

    public function update_password(Request $request)
    {
        $user = Auth::user();
        if($user)
        {
            if(empty($request->old_password) || empty($request->new_password))
            {
                return $this->sendError('Old Password and New Password fields are Required',[],401);  
            }
            if($request->new_password != $request->new_password_confirmation)
            {
                
                return $this->sendError("New Password Doesn't match with Confirm Password",[],401);   
            }
            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                
                return $this->sendError("Old Password Doesn't match!",[],401);    
            }

            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            
            return $this->sendResponse([], 'Password changed successfully'); 
        }
        else
        {
            return $this->sendError("Unauthorized",[],400);    
        }
    }
}
