<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lesson;
use App\Models\Notification;
use App\Models\post;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function getLesson($category){
         //return view('controller.view', compact('users','projects','foods'));
       // $lesson=lesson::paginate(16);
        //return view('lessons',['lessons'=>$lesson]);
        return $category;
    }
    
    public function addLesson(Request $req){

	
        //add video lesson
        $cate=$req->cate;
	    $date=$req->date;     
		$isVip=$req->isVip;
		$isChannel=$req->isChannel;
		$link=$req->link;
		$title=$req->title;
        
        //add post
	    $body=$req->body;
	    $has_video=$req->hasVideo;
	    $major=$req->major;
	    
	    if(!empty($req->youtubeImage)&&isset($req->youtubeImage)){
	        $imagePath=$req->youtubeImage;
	    }else{
	        $imagePath="";
	    }
        
        $lesson=new lesson;
        $lesson->cate=$cate;
        $lesson->date=$date;
        $lesson->isVideo=$has_video;
        $lesson->isVip=$isVip;
        $lesson->isChannel=$isChannel;
        $lesson->link=$link;
        $lesson->title=$title;
        $lesson->major=$major;
        $lesson->save();
        
        $post=new post;
	    $post->post_id=$date;
	    $post->learner_id=10000;
	    $post->body=$body;
	    $post->post_like=0;
	    $post->comments=0;
	    $post->image=$imagePath;
	    $post->video_url="";
	    $post->has_video=$has_video;
	    $post->view_count=0;
	    $post->major=$major;
	    $post->save();
        
        $notification=new Notification;
        $notification->post_id=$date;
        $notification->comment_id=0;
        $notification->owner_id=1001;
        $notification->writer_id='10000';
        $notification->action=2;
        $notification->time=$date;
        $notification->seen=2;
        $notification->save();
        
	    return "success fully added";
    }
     
    public function koreaHome(){
         //get word of the day
        $thisDay =date('j');
        $saveDay=DB::table('Timer')->value('day');
        $fetchId=DB::table('Timer')->value('korea');
        
        
        if($thisDay==$saveDay){
            $word=DB::table('ko_word_of_days')
            ->where('id',$fetchId)
            ->get();
            
           
            
        }else{
           $fetchId++;
           $affected =DB::table('Timer')
           ->update(
               ['korea'=>$fetchId,
               'day'=>$thisDay]
               );
            
            $word=DB::table('ko_word_of_days')
            ->where('id',$fetchId)
            ->get();
            
            if(!sizeof($word)==0){
                  
            }else{
                $fetchId=1;
                DB::table('Timer')
                ->update(['korea'=>$fetchId]);
                 $word=DB::table('ko_word_of_days')
                ->where('id',$fetchId)
                ->get();
                 
            }
        }
        
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
        
        $lessons=DB::table('lessons')
        ->selectRaw("
                 *
            ")
        ->where('lessons.major',$major)
        ->where('lessons.cate',$cate)
        ->orderBy('lessons.isVideo','desc')
        ->orderBy('id','asc')
        ->offset($count)
        ->limit(30)
        ->get();
        
        return $lessons;
        
    }
    
    public function fetchVideos(Request $req){
        $major=$req->major;
        $cate=$req->cate;
        $count=$req->count;
        
        $lessons=DB::table('lessons')
        ->selectRaw("
                 *
            ")
        ->where('lessons.major',$major)
        ->where('lessons.cate',$cate)
        ->orderBy('lessons.id','desc')
        ->offset($count)
        ->limit(30)
        ->get();
        
        return $lessons;
        
    }
    
    public function findAVideo(Request $req){
        $major=$req->major;
        $searching=$req->searching;
        $cate=$req->cate;
        
        if($major=="korean"){
            $major="korea";
        }
         
        $video=DB::table('lessons')
            ->selectRaw("
                 *
                ")
            ->where('isVip',0)
            ->where('title', 'like', '%'.$searching.'%')
            ->where('isVideo',1)
            ->where('major',$major)
            ->where('isChannel',1)
            ->get();
        return $video;
                    
        
    }
         
    public function koreaLessonList($category){
                 //get word of the day
        $thisDay =date('j');
        $saveDay=DB::table('Timer')->value('day');
        $fetchId=DB::table('Timer')->value('korea');
        
        
        if($thisDay==$saveDay){
            $word=DB::table('ko_word_of_days')
            ->where('id',$fetchId)
            ->get();
            
           
            
        }else{
           $fetchId++;
           $affected =DB::table('Timer')
           ->update(
               ['korea'=>$fetchId,
               'day'=>$thisDay]
               );
            
            $word=DB::table('ko_word_of_days')
            ->where('id',$fetchId)
            ->get();
            
            if(!sizeof($word)==0){
                  
            }else{
                $fetchId=1;
                DB::table('Timer')
                ->update(['korea'=>$fetchId]);
                 $word=DB::table('ko_word_of_days')
                ->where('id',$fetchId)
                ->get();
                 
            }
        }
        
        //the default lesson   return view('controller.view',);
        $lesson=lesson::where('cate',$category)
                 ->paginate(16);
        return view('easykorea.lessons',[
            'lessons'=>$lesson,
            'words'=>$word
        ]);
    }
    
    
    
}
