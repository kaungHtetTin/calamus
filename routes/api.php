<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Page Routes
Route::get('/home',[MainController::class,'getHome']);
Route::get('/courses',[MainController::class,'getCoursePage']);
Route::get('/courses/detail/{courseId}',[MainController::class,'getCourseDetailPage']);


//instructor routes
Route::get('/instructors',[MainController::class,'getInstructorPage']);
Route::get('/instructors/detail/{id}',[TeacherController::class,'getTeacherDetail']);

//blog routes
Route::get('/blogs',[PostController::class,'getBlogs']);
Route::get('/blogs/detail/{id}',[PostController::class,'getBlogPostDetail']);


Route::get('/courses/{category}',[CourseController::class,'getCourses']);

Route::get('/demo-url',  function  (Request $request)  {
   return response()->json(['Laravel CORS Demo']);
});

