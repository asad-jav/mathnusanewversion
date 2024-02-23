<?php

namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'password' => ['required'],
            'email' => ['required', 'email'],
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $user = User::with('grade')->where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password))
        {
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            $response = ['user'=>$user,'token'=>$token];
            return $this->sendResponse($response, 'User login successfully.');
        } 
        return $this->sendError('Credentails does not match our records',[],400);
    }
  
}
