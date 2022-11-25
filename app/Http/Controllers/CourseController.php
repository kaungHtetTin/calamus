<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\course;
use App\Models\rating;
use App\Models\CourseEnroll;
use Hash;

class CourseController extends Controller
{
    public function getAppForm($major){
        //main course
        $mainCourse=course::where('major',$major)->get();
        $myResponse['mainCourse']=$mainCourse;
    
        //main function    
        $functions=DB::table('functions')
                    ->selectRaw("
                        title,link_url,image_url
                    ")->where('function_type',1)->where('major',$major)->get();
        $myResponse['functions']=$functions;
        
        //video Channels
        $videoChannels=DB::table('lessons_categories')
                    ->selectRaw("category_title as category, id as category_id")->where('course_id',9)->where('major',$major)->orderBy('sort_order','desc')->get();
        $myResponse['videoChannels']=$videoChannels;
        
        //additonal lessons
        $additionalLessons=DB::table('lessons_categories')
                    ->selectRaw("category_title as category, image_url,id as category_id")->where('course_id',14)->where('major',$major)->orderBy('sort_order','asc')->get();
        $myResponse['additionalLessons']=$additionalLessons;
        
        //lesson with k-drama series;
        $kDramas=DB::table('lessons_categories')
                    ->selectRaw(" category_title as title ,image_url,id as drama_id")->where('course_id',8)->where('major',$major)->orderBy('sort_order','desc')->get();
         $myResponse['kDramas']=$kDramas;
         
         
        $engNoteBooks=DB::table('lessons_categories')
                    ->selectRaw(" category_title as title ,image_url,id as category_id")->where('course_id',10)->where('major',$major)->orderBy('sort_order','asc')->get();
        $myResponse['engNoteBooks']=$engNoteBooks;
        
        
        $voa=DB::table('lessons_categories')
                    ->selectRaw(" category_title as title ,image_url,id as category_id")->where('course_id',12)->where('major',$major)->orderBy('sort_order','asc')->get();
        $myResponse['voa']=$voa;
         
        
        return $myResponse;
    }
    
    public function getCategoryByCourse(Request $req,$major){
        $course_id=$req->courseId;
        $categories=DB::table('lessons_categories')
                    ->selectRaw("id,category_title,image_url")->where('course_id',$course_id)->orderBy('sort_order','asc')->get();
                    
        return $categories;
    }
    
    public function startACourse($major,Request $req){
        $user_id=$req->user_id;
        $course_id=$req->course_id;
        
        
        $courseEnroll=CourseEnroll::where('course_id',$course_id)->where('user_id',$user_id)->first();
        if(!$courseEnroll){
            $enroll=new CourseEnroll;
            $enroll->user_id=$user_id;
            $enroll->course_id=$course_id;
            $enroll->start_date=now();
            $enroll->save();
        }else{
            CourseEnroll::where('course_id',$course_id)->where('user_id',$user_id)
            ->update(['end_date'=>now()]);
        }
        
        return "success";
    }
    
    public function getCourseEnrollData($major,Request $req){
        $user_id=$req->user_id;
        $course_id=$req->course_id;
        
        $courseEnroll=CourseEnroll::where('course_id',$course_id)->where('user_id',$user_id)->first();
        
        return $courseEnroll;
        
    }
    
    public function getReviews($major,Request $req){
        $user_id=$req->user_id;
        $course_id=$req->course_id;
        $course=course::where('major',$major)->where('course_id',$course_id)->first();
        
        
        $rating=DB::table('ratings')
            ->selectRaw("
                  count(*) as total_rating,
                  star
                ")
            ->where('course_id',$course_id)
            ->groupBy('star')
            ->get();
        
        
        $rated=rating::where('user_id',$user_id)->where('course_id',$course_id)->first();
        if($rated){
            $response['rated']=true;
            $response['my_review']=$rated;
        }else{
            $response['rated']=false;
        }
        
        $response['course']=$course;
        $response['rating']=$rating;
        
        return $response;
        
    }
    
}
