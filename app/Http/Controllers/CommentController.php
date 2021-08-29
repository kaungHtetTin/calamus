<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\post;
use App\Models\mylike;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\KoreanUserData;
use App\Models\EnglishUserData;

class CommentController extends Controller
{
    
     public function fetchCommentEnglish(Request $req){
         //new method
       $post_id=$req->post_id;
	    $time=$req->time;
	    $userId=$req->user_id;
	    
        if(!empty($time)){
    	        $affect=DB::table('notification')
    	       ->where('time',$time)
    	       ->update(['seen'=>1]);
    	      
    	 }

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
        	    posts.image as postImage
        	  
            ")
        ->where('posts.post_id',$post_id)
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->join('ee_user_datas','ee_user_datas.phone','=','posts.learner_id')
        ->get();
       
        foreach($posts as $post){
                    
            $post->is_liked=0;
            
            $likeRows=mylike::where('content_id',$post->postId)->get();
            foreach ($likeRows as $row){
                     
                $likesArr=json_decode($row->likes,true);
                
                $user_ids=array_column($likesArr,"user_id");
                     
                if(in_array( $userId, $user_ids)){
                    $post->is_liked=1;
                        
                }else{
                    $post->is_liked=0;
                }
            }
            
             $arr[]=$post;
            
        }
        
	    $go['post']=$arr;
	    
	    $comments=DB::table('comment')
	    ->selectRaw("
	        learners.learner_name as userName,
    	    ee_user_datas.token as userToken,
    	    learners.learner_image as userImage,
    	    ee_user_datas.is_vip as vip,
    	    comment.body,
    	    comment.time,
    	    comment.writer_id as userId,
    	    comment.likes,
    	    comment.image as commentImage,
    	    CASE
            WHEN  EXISTS (SELECT NULL FROM comment_likes l 
            WHERE l.user_id ='$userId'and l.comment_id =comment.time) THEN 1
            ELSE 0
            END as is_liked
    	   
	        ")
	    ->where('comment.post_id',$post_id)
	    ->join('learners','learners.learner_phone','=','comment.writer_id')
	    ->join('ee_user_datas','ee_user_datas.phone','=','comment.writer_id')
	    ->orderBy('comment.time')
	    ->get();
	    
	    $go['comments']=$comments;
	    
	    return $go;
	    
    }
    
    
    public function fetchCommentKorean(Request $req){
        //new method
        $post_id=$req->post_id;
	    $time=$req->time;
	    $userId=$req->user_id;
	    
        if(!empty($time)){
    	        $affect=DB::table('notification')
    	       ->where('time',$time)
    	       ->update(['seen'=>1]);
    	      
    	 }

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
        	    posts.image as postImage
        	  
            ")
        ->where('posts.post_id',$post_id)
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->join('ko_user_datas','ko_user_datas.phone','=','posts.learner_id')
        ->get();
       
        foreach($posts as $post){
                    
            $post->is_liked=0;
            
            $likeRows=mylike::where('content_id',$post->postId)->get();
            foreach ($likeRows as $row){
                     
                $likesArr=json_decode($row->likes,true);
                
                $user_ids=array_column($likesArr,"user_id");
                     
                if(in_array( $userId, $user_ids)){
                    $post->is_liked=1;
                        
                }else{
                    $post->is_liked=0;
                }
            }
            
             $arr[]=$post;
            
        }
        
	    $go['post']=$arr;
	    
	    $comments=DB::table('comment')
	    ->selectRaw("
	        learners.learner_name as userName,
    	    ko_user_datas.token as userToken,
    	    learners.learner_image as userImage,
    	    ko_user_datas.is_vip as vip,
    	    comment.body,
    	    comment.time,
    	    comment.writer_id as userId,
    	    comment.likes,
    	    comment.image as commentImage,
    	    CASE
            WHEN  EXISTS (SELECT NULL FROM comment_likes l 
            WHERE l.user_id ='$userId'and l.comment_id =comment.time) THEN 1
            ELSE 0
            END as is_liked
    	   
	        ")
	    ->where('comment.post_id',$post_id)
	    ->join('learners','learners.learner_phone','=','comment.writer_id')
	    ->join('ko_user_datas','ko_user_datas.phone','=','comment.writer_id')
	    ->orderBy('comment.time')
	    ->get();
	    
	    $go['comments']=$comments;
	    
	    return $go;
	    
    }
    
    
   

    public function addComment(Request $req){
      
    
        $post_id=$req->post_id;
        $writer_id=$req->writer_id;  
	    $time=$req->time;
	    $owner_id=$req->owner_id;
		$action=$req->action;
		$image="";
		
	 
		
		if(!empty($req->body)){
		      $body=$req->body;
		}else{
		    $body="";
		}
		
		$myPath="https://www.calamuseducation.com/uploads/";
		
		
      
        if(!empty($req->myfile)){
            $file=$req->file('myfile');
            $result=Storage::disk('calamusPost')->put('comments',$file);
            $image=$myPath.$result;
        }
        
        //save comment to comment table
        $comment=new Comment;
        $comment->post_id=$post_id;
        $comment->writer_id=$writer_id;
        $comment->body=$body;
        $comment->time=$time;
        $comment->likes=0;
        $comment->image=$image;
        $comment->save();
     
        // make increment in comments colomn of post table
        post::where('post_id', $post_id)
        ->update([
          'comments'=> DB::raw('comments+1')
        ]);
        
     
        
        //save to notification table
        
        if($owner_id!=$writer_id){
            $notification=new Notification;
            $notification->post_id=$post_id;
            $notification->owner_id=$owner_id;
            $notification->comment_id=$time;
            $notification->writer_id=$writer_id;
            $notification->action=$action;
            $notification->time=$time;
            $notification->seen=0;
            $notification->save();
    	}
    	
    	//increase discussion count;
        $major=post::where('post_id', $post_id)->first();
    	$major=$major->major;
     	if($major=="korea" and $writer_id!="10000" and $writer_id!="09979638384"){
            KoreanUserData::where('phone', $writer_id)
            ->update([
              'discuss_count'=>DB::raw('discuss_count+1')
            ]);
         }
        return "added";
    }
    
    public function deleteComment(Request $req){
        $time=$req->time;
        $post=$req->postId;
        
        $notification=Notification::where('time',$time)->delete();
        $notification=Notification::where('comment_id',$time)->delete();
        
        $image=Comment::where('time',$time)->first();
        $image=$image->image;
        if($image!=""){
            $image = basename($image);
            $file=$_SERVER['DOCUMENT_ROOT'].'/uploads/comments/'.$image;
            if(file_exists($file)){
                unlink($file);
            }
        }
        
        $comment = Comment::where('time', $time)->delete();
        
        DB::table('comment_likes')
        ->where('comment_id',$time)->delete();
        
        post::where('post_id', $post)
        ->update([
          'comments'=> DB::raw('comments-1')
        ]);
        
        echo "Comment Deleted";
    }
}
