<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lesson;
use App\Models\Notification;
use App\Models\post;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{

    public function fetchLessons(Request $req,$major){
        
        $page=$req->page;
        $cate=$req->category;
        $userId=$req->userId;
        
        $limit=30;
        
        $count=($page-1)*$limit;
        $nextCount=$page*$limit;
        
        $checkNextPage=DB::table('lessons')->selectRaw("lessons.id ")->where('lessons.category_id',$cate)->orderBy('lessons.id','asc')->offset($nextCount)->limit($limit)->get();
        
        if(count($checkNextPage)>0){
            $response['nextPageToken']=$page+1;
        }else{
             $response['nextPageToken']=null;
        }
        
<<<<<<< HEAD
        
=======
        //the default lesson   return view('controller.view',);
        $lesson=lesson::where('cate',"basic_word_construction")
                 ->paginate(16);
        return view('easykorea.home',[
            'lessons'=>$lesson,
            'words'=>$word
        ]);
    }
     
     
    public function showLessonDetail($id){
        $lesson=lesson::find($id);
        $lessonData=file_get_contents($lesson->link);
        $lessonData=json_decode($lessonData);
        return view('easykorea.detailactivity',['lessonData'=>$lessonData]);
    }
    
    public function showVideo($id){
        $lesson=lesson::find($id);
        $post=post::where('post_id',$lesson->date)->first();
        $comments=DB::table('comment')
	    ->selectRaw('
	        learners.learner_name as userName,
    	    learners.learner_image as userImage,
    	    comment.body,
    	    comment.time,
    	    comment.writer_id as userId
	        ')
	    ->where('comment.post_id',$lesson->date)
	    ->join('learners','learners.learner_phone','=','comment.writer_id')
	    ->join('ko_user_datas','ko_user_datas.phone','=','comment.writer_id')
	    ->orderBy('comment.time')
	    ->get();
        
        
    
        return view('easykorea.videolessonactivity',[
        'lessonData'=>$lesson,
        'post'=>$post,
        'comments'=>$comments
        ]);
        
        
    }
    
    public function fetchLessons(Request $req){
        $major=$req->major;
        $cate=$req->cate;
        $count=$req->count;
    
>>>>>>> 2c350371eaf59bd255c30ea95ef38a700d32f3a2
        $lessons=DB::table('lessons')
        ->selectRaw("
                lessons.id,
                lessons.cate,
                lessons.link,
                lessons.title,
                lessons.isVideo,
                lessons.isVip,
                lessons.date,
                lessons_categories.image_url,
                lessons.thumbnail,
                CASE
                WHEN  EXISTS (SELECT NULL FROM studies std 
                WHERE std.learner_id ='$userId'and std.lesson_id =lessons.id) THEN 1
                ELSE 0
                END as learned
            ")
<<<<<<< HEAD
        ->where('lessons.category_id',$cate)
        ->join("lessons_categories","lessons_categories.id","=","lessons.category_id")
=======
        ->where('lessons.major',$major)
        ->where('lessons_categories.category',$cate)
        ->join('lessons_categories','lessons_categories.id','=','lessons.category_id')
>>>>>>> 2c350371eaf59bd255c30ea95ef38a700d32f3a2
        ->orderBy('lessons.isVideo','desc')
        ->orderBy('lessons.id','asc')
        ->offset($count)
        ->limit($limit)
        ->get();
        
        $response['lessons']=$lessons;
        return $response;
        
    }
    
    public function fetchVideos(Request $req,$major){

        $cate=$req->category;
        $userId=$req->userId;
        $page=$req->page;
        
        $limit=30;
        
        $count=($page-1)*$limit;
        
        
        $lessons=DB::table('lessons')
        ->selectRaw("
                lessons.id,
                lessons.category_id as cate,
                lessons.link,
                lessons.title,
                lessons.isVideo,
                lessons.isVip,
                lessons.date,
                lessons.thumbnail,
                CASE
                WHEN  EXISTS (SELECT NULL FROM studies std 
                WHERE std.learner_id ='$userId'and std.lesson_id =lessons.id) THEN 1
                ELSE 0
                END as learned
            ")
<<<<<<< HEAD
        ->where('lessons.category_id',$cate)
=======
        ->where('lessons.major',$major)
        ->where('lessons_categories.category',$cate)
        ->join('lessons_categories','lessons_categories.id','=','lessons.category_id')
>>>>>>> 2c350371eaf59bd255c30ea95ef38a700d32f3a2
        ->orderBy('lessons.id','desc')
        ->offset($count)
        ->limit($limit)
        ->get();
        
        $response['videos']=$lessons;
        return $response;
        
    }
    
    public function findAVideo(Request $req,$major){
      
        $search=$req->search;
        $userId=$req->userId;
        
        $video=DB::table('lessons')
            ->selectRaw("
                    lessons.id,
                    lessons.category_id as cate,
                    lessons.link,
                    lessons.title,
                    lessons.isVideo,
                    lessons.isVip,
                    lessons.date,
                    CASE
                    WHEN  EXISTS (SELECT NULL FROM studies std 
                    WHERE std.learner_id ='$userId'and std.lesson_id =lessons.id) THEN 1
                    ELSE 0
                    END as learned  
                ")
            ->where('isVip',0)
            ->where('title', 'like', '%'.$search.'%')
            ->where('isVideo',1)
            ->where('major',$major)
            ->where('isChannel',1)
            ->get();
        return $video;
                    
    }
    
    public function getDayPlan(Request $req){
        $userid=$req->userid;
        $course=$req->course;
        
        $plans=DB::table('study_plan')
            ->selectRaw("
               
                lessons.title as lesson_title,day,
                CASE
                WHEN  EXISTS (SELECT NULL FROM studies std 
                WHERE std.learner_id ='$userid'and std.lesson_id =study_plan.lesson_id) THEN 1
                ELSE 0
                END as learned
            ")
            ->join('lessons','lessons.id','=','study_plan.lesson_id')
            ->where('study_plan.course_id',$course)
            ->orderby('day','asc')
            ->orderby('study_plan.id','asc')
            ->get();
            
        for($i=0;$i<count($plans);$i++){
            $day=$plans[$i]->day;
            $day--;
           
            $lessons[$day][]=$plans[$i];
        }
        
        return $lessons;
    }
    
    public function getLessonsByDayPlan($major,Request $req){
        $course_id=$req->course_id;
        $day=$req->day;
        $userId=$req->userId;
        
        
        $lessons=DB::table('study_plan')
        ->selectRaw("
         lessons.id,
                lessons.cate,
                lessons.link,
                lessons.title,
                lessons.isVideo,
                lessons.isVip,
                lessons.date,
                lessons_categories.image_url,
                lessons.thumbnail,
                CASE
                WHEN  EXISTS (SELECT NULL FROM studies std 
                WHERE std.learner_id ='$userId'and std.lesson_id =lessons.id) THEN 1
                ELSE 0
                END as learned
        ")
        ->join('lessons','lessons.id','=','study_plan.lesson_id')
        ->join('lessons_categories','lessons.category_id','=','lessons_categories.id')
        ->where('study_plan.day',$day)
        ->where('study_plan.course_id',$course_id)
        ->get();
        
        return $lessons;
    }
    
    public function loadPlayer($major, Request $req){
       $post_id=$req->post_id;
      
       
   
         $post=post::where('post_id',$post_id)->first();
        
         return view('player',[
             'post'=>$post
             ]);
    }
    
}
