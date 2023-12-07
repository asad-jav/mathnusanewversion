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
            return response()->json(['message' => 'User Found','user' => $user], 200);
        }
        else
        {
            return response()->json(['error' => 'User Not Found'], 404);
        }
    }

    public function update_password(Request $request)
    {
        $user = Auth::user();
        if($user)
        {
            if(empty($request->old_password) || empty($request->new_password))
            {
                return response()->json(["error" => "Old Password and New Password fields are Required"],401);
            }
            if($request->new_password != $request->new_password_confirmation)
            {
                return response()->json(["error"=>"New Password Doesn't match with Confirm Password"],401);
            }
            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return response()->json(["error"=>"Old Password Doesn't match!"],401);
            }

            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return response()->json(['message' => 'Password changed successfully'], 200);
        }
        else
        {
            return response()->json(['error' => 'Unauthorized'], 400);
        }
    }
}
