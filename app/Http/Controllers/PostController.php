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
use App\Models\lesson;
use App\Models\study;
use App\Models\EnglishUserData;
date_default_timezone_set("Asia/Yangon");
class PostController extends Controller
{
    
    public function fetchPost(Request $req,$major){
        
        $dataStore=$req->mCode;
        $userId=$req->userId;
        $page=$req->page;
        
        $limit=10;
        $count=($page-1)*$limit;
        
        $dataStore=$dataStore."_user_datas";

        $posts=DB::table('posts')
            ->selectRaw("
                    learners.learner_name as userName,
            	    learners.learner_phone as userId,
            	    $dataStore.token as userToken,
            	    learners.learner_image as userImage,
            	    $dataStore.is_vip as vip,
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
            ->join($dataStore,"$dataStore.phone",'=','posts.learner_id')
            ->orderBy('posts.id','desc')
            ->offset($count)
            ->limit($limit)
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
                $response['posts']=$arr;
                $response['nextPageToken']='notDefinedNow';
                return $response;
                    
            }else{
                $response['posts']=false;
                $response['nextPageToken']=null;
                return $response;
            }
    }
    
 
    public function fetchDiscussion(Request $req,$major){
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
    
    
    public function addPost(Request $req,$major){
        
        $post_id=round(microtime(true)*1000);
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
       
       if($major=="english" and $learner_id!="1000" and $learner_id!="09979638384"){
            EnglishUserData::where('phone', $learner_id)
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
    
    public function getAndUpdateViewCount(Request $req){
        //new method
        $post_id=$req->post_Id;
        $userId=$req->user_id;
        
        $lessonId=lesson::where('date',$post_id)->first();
        $lessonId=$lessonId->id;
        
         $lessonInfo=study::where('lesson_id',$lessonId)->where('learner_id',$userId)->first();
        if(!$lessonInfo){
            $study=new study;
            $study->learner_id=$userId;
            $study->lesson_id=$lessonId;
            $study->frequent=1;
            $study->save();
        }else{
            study::where('lesson_id',$lessonId)->where('learner_id',$userId)
            ->update(['frequent'=>DB::raw("frequent+1")]);
        }
        
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
    
    
    public function getVideodownloadLink(Request $req,$major){
            
        $postId=$req->postId;
        $postData=post::where('post_id',$postId)->first();
          
        $link=$postData->video_url;
        return $link;
    }
    
    
    //testing area

    
}
