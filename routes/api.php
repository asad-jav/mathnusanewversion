<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\QuizController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
  
Route::post('/login', [LoginController::class,'login']);
 
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/user/profile',[ProfileController::class,'user_profile']);
    Route::post('/auth/update/password',[ProfileController::class,'update_password']);
    Route::get('/auth/quiz/',[QuizController::class,'show_quiz']);
    Route::get('/auth/quiz/questions/{quiz_id}/{level_id}',[QuizController::class,'show_quiz_question']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
