<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rating;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    
    public function getRating($major, Request $req){
        $course_id=$req->course_id;
        $dataStore=$req->mCode;
        $page=$req->page;
        $star=$req->star;
           
        $limit=30;
        $count=($page-1)*$limit;
        
        $dataStore=$dataStore."_user_datas";
        
        if($star==0){
            $ratings=DB::table('ratings')
            ->selectRaw("
                    learners.learner_name as userName,
            	    learners.learner_phone as userId,
            	    learners.learner_image as userImage,
            	    $dataStore.is_vip as vip,
            	    ratings.star as star,
            	    ratings.review,
            	    ratings.time
            	    
                ")
            ->where('ratings.course_id',$course_id)
            ->join('learners','learners.learner_phone','=','ratings.user_id')
            ->join($dataStore,"$dataStore.phone",'=','ratings.user_id')
            ->orderBy('ratings.id','desc')
            ->offset($count)
            ->limit($limit)
            ->get();
        }else{
            $ratings=DB::table('ratings')
            ->selectRaw("
                    learners.learner_name as userName,
            	    learners.learner_phone as userId,
            	    learners.learner_image as userImage,
            	    $dataStore.is_vip as vip,
            	    ratings.star as star,
            	    ratings.review,
            	    ratings.time
            	    
                ")
            ->where('ratings.star',$star)
            ->where('ratings.course_id',$course_id)
            ->join('learners','learners.learner_phone','=','ratings.user_id')
            ->join($dataStore,"$dataStore.phone",'=','ratings.user_id')
            ->orderBy('ratings.id','desc')
            ->offset($count)
            ->limit($limit)
            ->get();
        }
   
        return $ratings;
    }
    
    
    public function addRating($major,Request $req){
        $user_id=$req->user_id;
        $course_id=$req->course_id;
        $star=$req->star;
        $review=$req->review;
        if($review==null)$review="";
        
        $time=round(microtime(true)*1000);
        $rating=new rating;
        $rating->user_id=$user_id;
        $rating->course_id=$course_id;
        $rating->star=$star;
        $rating->review=$review;
        $rating->time=$time;
        $rating->save();
        
        return $req;
        
    }
    
    public function deleteRating($major,Request $req){
        $user_id=$req->user_id;
        $course_id=$req->course_id;
 
        rating::where('user_id', $user_id)->where('course_id',$course_id)->delete();
        
        return $req;
        
    }
}
