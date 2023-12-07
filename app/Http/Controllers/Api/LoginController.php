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

        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password))
        {
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            $response = ['user'=>$user,'token'=>$token];
            return response()->json($response,200);
        }
        $response = ['message'=>'Credentails does not match our records'];
        return response()->json($response,400);
    }
    // public function login(Request $request): JsonResponse
    // { 
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //         $success['user'] =  $user;
    //         return $this->sendResponse($success, 'User login successfully.');
    //     } else {
    //         return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    //     }
    // }
}
