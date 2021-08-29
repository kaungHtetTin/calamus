<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Report;
use App\Models\mylike;
use App\Models\KoreanUserData;
use App\Models\EnglishUserData;

class PostController extends Controller
{
 
    
    
     public function fetchEnglishPost(Request $req){
       
        $major="english";
        $userId=$req->userId;
        $count=$req->count;
        $selection=$req->selection;
        
        if($selection=="me"){
        $posts=DB::table('posts')
        ->selectRaw("
                learners.learner_name as userName,
        	    learners.learner_phone as userId,
        	    ee_user_datas.token as userToken,
        	    learners.learner_image as userImage,
        	    ee_user_datas.is_vip as vip,
        	    posts.post_id as postId,
        	    posts.body as body,
        	    posts.post_like as postLikes,
        	    posts.comments,
        	    posts.image as postImage,
        	    posts.view_count as viewCount,
        	    posts.has_video
            ")
        ->where('posts.major',$major)
        ->where('posts.learner_id',$userId)
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->join('ee_user_datas','ee_user_datas.phone','=','posts.learner_id')
        ->orderBy('posts.id','desc')
        ->offset($count)
        ->limit(30)
        ->get();
         if(!sizeof($posts)==0){
                
                foreach($posts as $post){
                    
                    $post->is_liked=0;
                    $likeRows=mylike::where('content_id',$post->postId)->get();
                    
                    foreach ($likeRows as $row){
                    
                         $likesArr=json_decode($row->likes,true);
                    
                         $user_ids=array_column($likesArr,"user_id");
                         
                        if(in_array( $userId, $user_ids)){
                            $post->is_liked=1;
                            
                        }
                    }
                        $arr[]=$post;
                
                }
                
                return $arr;
                    
            }else{
                    return false;
            }
         
        }else{
            
        $posts=DB::table('posts')
        ->selectRaw("
                learners.learner_name as userName,
        	    learners.learner_phone as userId,
        	    ee_user_datas.token as userToken,
        	    learners.learner_image as userImage,
        	    ee_user_datas.is_vip as vip,
        	    posts.post_id as postId,
        	    posts.body as body,
        	    posts.post_like as postLikes,
        	    posts.comments,
        	    posts.image as postImage,
        	    posts.view_count as viewCount,
        	    posts.has_video
            ")
        ->where('posts.major',$major)
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->join('ee_user_datas','ee_user_datas.phone','=','posts.learner_id')
        ->orderBy('posts.id','desc')
        ->offset($count)
        ->limit(30)
        ->get();
        
            if(!sizeof($posts)==0){
                
                foreach($posts as $post){
                    
                    $post->is_liked=0;
                    $likeRows=mylike::where('content_id',$post->postId)->get();
                    
                    foreach ($likeRows as $row){
                    
                         $likesArr=json_decode($row->likes,true);
                    
                         $user_ids=array_column($likesArr,"user_id");
                         
                        if(in_array( $userId, $user_ids)){
                            $post->is_liked=1;
                            
                        }
                    }
                        $arr[]=$post;
                
                }
                
                return $arr;
                    
            }else{
                    return false;
            }
        
         
        }
    }
    
    public function fetchDiscussion(Request $req){
        $major=$req->major;
        $userId=$req->userId;
        $count=$req->count;
        
            $posts=DB::table('posts')
            ->selectRaw("
                    learners.learner_name as userName,
                     learners.learner_phone as userId,
            	    learners.learner_image as userImage,
            	    posts.post_id as postId,
            	    posts.body as body,
            	    posts.post_like as postLikes,
            	    posts.comments,
            	    posts.image as postImage,
            	    posts.view_count as viewCount,
            	    posts.has_video
            	    
                ")
            ->where('posts.major',$major)
             ->where('posts.learner_id',$userId)
            ->join('learners','learners.learner_phone','=','posts.learner_id')
            ->orderBy('posts.id','desc')
            ->offset($count)
            ->limit(10)
            ->get();
            
        
        return $posts;
        
    }
    
    
    public function fetchKoreanPost(Request $req){
        //new method
        $major="korea";
        $userId=$req->userId;
        $count=$req->count;
  

        $posts=DB::table('posts')
            ->selectRaw("
                    learners.learner_name as userName,
            	    learners.learner_phone as userId,
            	    ko_user_datas.token as userToken,
            	    learners.learner_image as userImage,
            	    ko_user_datas.is_vip as vip,
            	    posts.post_id as postId,
            	    posts.body as body,
            	    posts.post_like as postLikes,
            	    posts.comments,
            	    posts.image as postImage,
            	    posts.view_count as viewCount,
            	    posts.has_video
            	    
                ")
            ->where('posts.major',$major)
            ->join('learners','learners.learner_phone','=','posts.learner_id')
            ->join('ko_user_datas','ko_user_datas.phone','=','posts.learner_id')
            ->orderBy('posts.id','desc')
            ->offset($count)
            ->limit(10)
            ->get();
        
            if(!sizeof($posts)==0){
                
                foreach($posts as $post){
                    
                    $post->is_liked=0;
                    $likeRows=mylike::where('content_id',$post->postId)->get();
                    
                    foreach ($likeRows as $row){
                    
                         $likesArr=json_decode($row->likes,true);
                    
                         $user_ids=array_column($likesArr,"user_id");
                         
                        if(in_array( $userId, $user_ids)){
                            $post->is_liked=1;
                            
                        }
                    }
                        $arr[]=$post;
                
                }
                
                return $arr;
                    
            }else{
                    return false;
            }
        
        
    }
    
    
    
    public function fetchKoreanPostT(Request $req){
        // old method
        $major="korea";
        $userId=$req->userId;
        $count=$req->count;
        $selection=$req->selection;
        
        if($selection=="me"){
        $posts=DB::table('posts')
        ->selectRaw("
                learners.learner_name as userName,
        	    learners.learner_phone as userId,
        	    ko_user_datas.token as userToken,
        	    learners.learner_image as userImage,
        	    ko_user_datas.is_vip as vip,
        	    posts.post_id as postId,
        	    posts.body as body,
        	    posts.post_like as postLikes,
        	    posts.comments,
        	    posts.image as postImage,
        	    posts.view_count as viewCount,
        	    posts.has_video,
            	CASE
                WHEN  EXISTS (SELECT NULL FROM likes l 
                WHERE l.user_id ='$userId'and l.content_id =posts.post_id) THEN 1
                ELSE 0
                END as is_liked
        	  
            ")
        ->where('posts.major',$major)
        ->where('posts.learner_id',$userId)
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->join('ko_user_datas','ko_user_datas.phone','=','posts.learner_id')
        ->orderBy('posts.id','desc')
        ->offset($count)
        ->limit(10)
        ->get();
         if(!sizeof($posts)==0){
                 return $posts;  
            }else{
                return false;
            }
         
        }else{
            
        $posts=DB::table('posts')
        ->selectRaw("
                learners.learner_name as userName,
        	    learners.learner_phone as userId,
        	    ko_user_datas.token as userToken,
        	    learners.learner_image as userImage,
        	    ko_user_datas.is_vip as vip,
        	    posts.post_id as postId,
        	    posts.body as body,
        	    posts.post_like as postLikes,
        	    posts.comments,
        	    posts.image as postImage,
        	    posts.view_count as viewCount,
        	    posts.has_video,
        	    CASE
                WHEN  EXISTS (SELECT NULL FROM likes l 
                WHERE l.user_id ='$userId'and l.content_id =posts.post_id) THEN 1
                ELSE 0
                END as is_liked
        	    
            ")
        ->where('posts.major',$major)
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->join('ko_user_datas','ko_user_datas.phone','=','posts.learner_id')
        ->orderBy('posts.id','desc')
        ->offset($count)
        ->limit(10)
        ->get();
        
            if(!sizeof($posts)==0){
                 return $posts;  
            }else{
                return false;
            }
        
         
        }
    }
    
    public function fetchReportedPost(Request $req){
        $major=$req->major;
        $count=$req->count;
        
         $posts=DB::table('posts')
        ->selectRaw('
                learners.learner_name as userName,
        	    learners.learner_phone as userId,
        	    ko_user_datas.token as userToken,
        	    learners.learner_image as userImage,
        	    ko_user_datas.is_vip as vip,
        	    posts.post_id as postId,
        	    posts.body as body,
        	    posts.post_like as postLikes,
        	    posts.comments,
        	    posts.image as postImage,
        	    posts.view_count as viewCount,
        	    posts.has_video
            ')
        ->where('posts.major',$major)
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->join('ko_user_datas','ko_user_datas.phone','=','posts.learner_id')
        ->join('report','report.post_id','=','posts.post_id')
        ->orderBy('posts.id','desc')
        ->get();
        
        if($count==0){
            return $posts;  
        }else{
            return false;
        } 
    }
    
    
    public function addPost(Request $req){
        
        $post_id=$req->post_id;
	    $learner_id=$req->learner_id;
	  
	    
	    if(!empty($req->body)&&isset($req->body)){
	       $body=$req->body;
	    }else{
	        $body="";
	    }
	    
	    if(!empty($req->youtubeImage)&&isset($req->youtubeImage)){
	        $imagePath=$req->youtubeImage;
	    }else{
	        $imagePath="";
	    }
	    $has_video=$req->hasVideo;
	    $major=$req->major;
        
        $myPath="https://www.calamuseducation.com/uploads/";
        
        $file=$req->file('myfile');
      
        if(!empty($req->myfile)){
            $result=Storage::disk('calamusPost')->put('posts',$file);
            $imagePath=$myPath.$result;
        }
        
             
       $post=new post;
       $post->post_id=$post_id;
       $post->learner_id=$learner_id;
       $post->body=$body;
       $post->image=$imagePath;
       $post->has_video=$has_video;
       $post->major=$major;
       $post->post_like=0;
       $post->comments=0;
       $post->video_url="";
       $post->view_count=0;
       $post->save();
       
       if($major=="korea" and $learner_id!="1000" and $learner_id!="09979638384"){
            KoreanUserData::where('phone', $learner_id)
            ->update([
              'discuss_count'=>DB::raw('discuss_count+1')
            ]);
       }
       
    }
    
    
    public function editPost(Request $req){
        
        $post_id=$req->post_id;
        
        if(!empty($req->body)&&isset($req->body)){
            $body=$req->body;
            post::where('post_id', $post_id)->update(['body'=>$body]);
        }else{
             post::where('post_id',$post_id)->update(['body'=>""]);
        }
        
        if(!empty($req->myfile)&&isset($req->myfile)){
            //delete old image
            $image =post::where('post_id',$post_id)->get();
            $image=$image[0]['image'];
            if($image!=""){
                $image = basename($image);
                $file=$_SERVER['DOCUMENT_ROOT'].'/uploads/posts/'.$image;
                if(file_exists($file)){
                    unlink($file);
                }
            }
           
            //insert new image
            $file=$req->file('myfile');
            $result=Storage::disk('calamusPost')->put('posts',$file);
            $myPath="https://www.calamuseducation.com/uploads/";
            $imagePath=$myPath.$result;
            post::where('post_id',$post_id)->update(['image'=>$imagePath]);
        
        }else{
            if(empty($req->image)){
                //delete old image
                $image =post::where('post_id',$post_id)->get();
                $image=$image[0]['image'];
                if($image!=""){
                    $image = basename($image);
                    $file=$_SERVER['DOCUMENT_ROOT'].'/uploads/posts/'.$image;
                    if(file_exists($file)){
                        unlink($file);
                    }
                }
                post::where('post_id',$post_id)->update(['image'=>""]);
            }
        }
    }
 
    
 
    public function deletePost(Request $req){
  
        $postId=$req->postId;
        
        $image =post::where('post_id',$postId)->get();
        
        $image=$image[0]['image'];
        if($image!=""){
            $image = basename($image);
            $file=$_SERVER['DOCUMENT_ROOT'].'/uploads/posts/'.$image;
            if(file_exists($file)){
                unlink($file);
            }
        }
        $mylike=mylike::where('content_id',$postId)->delete();
        $notification=Notification::where('post_id',$postId)->delete();
        $comments= Comment::where('post_id', $postId)->get();
        foreach($comments as $comment){
            $commentImage=$comment->image;
            if(!empty($commentImage)){
                $commentImage= basename($commentImage);
                 $commentFile=$_SERVER['DOCUMENT_ROOT'].'/uploads/comments/'.$commentImage;
                if(file_exists($commentFile)){
                    unlink($commentFile);
                }
            }
        }
        
        
        $comment = Comment::where('post_id', $postId)->delete();
        
        $report=Report::where('post_id',$postId)->delete();
        $post=post::where('post_id',$postId)->delete();
      
        echo "Deleted";
    }
    
    
    public function removePostFromReportList(Request $req){
        $post_id=$req->postId;
        $report=Report::where('post_id',$post_id)->delete();
    }
 
    public function reportPost(Request $req){
        $post_id=$req->postId;
        
        $report=new Report;
        $report->post_id=$post_id;
        $report->save();
        
        echo "Reported";
    }
    
    
    public function getAndUpdateViewCountT(Request $req){
        //old method
        $post_id=$req->post_Id;
        $userId=$req->user_id;
        post::where('post_id', $post_id)
        ->update([
          'view_count'=>DB::raw('view_count+1')
        ]);
        
        $postData=post::where('post_id',$post_id)->get();
        
        
         $postData=DB::table('posts')
        ->selectRaw("
               
        	    posts.post_like as postLikes,
        	    posts.comments,
        	    posts.view_count,
        	    CASE
                WHEN  EXISTS (SELECT NULL FROM likes l 
                WHERE l.user_id ='$userId'and l.content_id =posts.post_id) THEN 1
                ELSE 0
                END as is_liked
        	    
            ")
        ->where('posts.post_id',$post_id)
        ->get();
        
        return $postData;
    }
    
    
    
    public function getAndUpdateViewCount(Request $req){
        //new method
        $post_id=$req->post_Id;
        $userId=$req->user_id;
        post::where('post_id', $post_id)
        ->update([
          'view_count'=>DB::raw('view_count+1')
        ]);
        
        $postData=post::where('post_id',$post_id)->get();
        
        $postData=DB::table('posts')
        ->selectRaw("
               
        	    posts.post_like as postLikes,
        	    posts.post_id,
        	    posts.comments,
        	    posts.view_count,
        	    posts.video_url,
        	    lessons.title
        	    
            ")
        ->where('posts.post_id',$post_id)
        ->join('lessons','lessons.date','=','posts.post_id')
        ->get();
        
        foreach($postData as $post){
                    
            $post->is_liked=0;
            $likeRows=mylike::where('content_id',$post->post_id)->get();
            foreach ($likeRows as $row){
                     
                $likesArr=json_decode($row->likes,true);
                
                 $user_ids=array_column($likesArr,"user_id");
                     
                if(in_array( $userId, $user_ids)){
                    $post->is_liked=1;
                        
                }
            }
            
            $arr[]=$post;
            
            return $arr;
                
        }
    }
    
    
    
    
    //testing area

    
}
