<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mylike;
use App\Models\CommentLike;
use App\Models\post;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Song;
date_default_timezone_set("Asia/Yangon");
class LikeController extends Controller
{
    public function addCommentLike(Request $req){
        
        $post_id=$req->post_id;
        $user_id=$req->user_id;
        $comment_id=$req->comment_id;
        $time=round(microtime(true) * 1000);
        
        $likeCheck=CommentLike::where('comment_id',$comment_id)
                        ->where('user_id',$user_id)->exists();
       
        if(!$likeCheck){

            DB::table('comment_likes')
    	        ->updateOrInsert(
    	        ['comment_id'=>$comment_id,'user_id'=>$user_id],
    	        [
    	            
    	            'comment_id'=>$comment_id,
    	            'user_id'=>$user_id
    	       ]
    	   );
            
        
            Comment::where('time',$comment_id)
            ->update([
                'likes'=>DB::raw('likes+1')
            
            ]);
            
            $commentOwner_id =Comment::where('time',$comment_id)->get();
            $commentOwner_id=$commentOwner_id[0]['writer_id'];
            
            if($user_id!=$commentOwner_id){
                
                $notification=new Notification;
                $notification->post_id=$post_id;
                $notification->comment_id=$comment_id;
                $notification->owner_id=$commentOwner_id;
                $notification->writer_id=$user_id;
                $notification->action=6;
                $notification->time=$time;
                $notification->seen=0;
                $notification->save();
                
            }
        }else{
            
            
            CommentLike::where('comment_id',$comment_id)
                ->where('user_id',$user_id)
                ->delete();
                
            Comment::where('time',$comment_id)
            ->update([
                'likes'=>DB::raw('likes-1')
            
            ]);
            
            notification::where('post_id',$post_id)
                ->where('writer_id',$user_id)
                ->where('action',6)
                ->delete();
        }
        
        $likeCountNow=Comment::where('time',$comment_id)->get('likes')->first();
        $myArr['count']=$likeCountNow->likes;
        $myArr['isLike']=$likeCheck;
        return $myArr;
    }
    
    
    public function fetchCommentsLikes(Request $req, $major){
        
        $mCode=$req->mCode;
        $contentId=$req->contentId;
        $page=$req->page;
        $major=$mCode."_user_datas";
        $limit=50;
        $count=($page-1)*$limit;
        
        $lists=DB::table('comment_likes')
            ->selectRaw("
                learners.learner_phone as userId,
                learners.learner_name as userName,
                learners.learner_image as userImage,
                $major.is_vip as vip
            ")
            ->where('comment_likes.comment_id',$contentId)
            ->join('learners','learners.learner_phone','=','comment_likes.user_id')
            ->join($major,$major.'.phone','=','comment_likes.user_id')
            ->orderBy('comment_likes.id','desc')
            ->offset($count)
            ->limit($limit)
            ->get();
            
        $response['likes']=$lists;
        $response['nextPageToke']='notDefinedNow';
        return $response;
    }
    
    
    public function addPostLike(Request $req){
        
        //new method
        
        $user_id=$req->user_id;
        $post_id=$req->post_id;
        $time=round(microtime(true)*1000);
        
        $likeCheck=mylike::where('content_id',$post_id)->get();
        $rowCount=$likeCheck->count();
        
        if($rowCount==0){
        
            $arr['user_id']=$user_id;
            $arr2[]=$arr;
			$likes=json_encode($arr2);
			
			
			DB::table('mylikes')
    	        ->updateOrInsert(
    	        ['content_id'=>$post_id],
    	        [
    	            
    	            'content_id'=>$post_id,
    	            'likes'=>$likes,
    	            'rowNo'=>0
    	       ]
    	   );
    	   
    	    post::where('post_id',$post_id)
            ->update([
                'post_like'=>DB::raw('post_like+1')
            
            ]);
 
            $postOwner_id =post::where('post_id',$post_id)->get();
            $postOwner_id=$postOwner_id[0]['learner_id'];
            
            if($user_id!=$postOwner_id){
                
                $notification=new Notification;
                $notification->post_id=$post_id;
                $notification->comment_id=0;
                $notification->owner_id=$postOwner_id;
                $notification->writer_id=$user_id;
                $notification->action=5;
                $notification->time=$time;
                $notification->seen=0;
                $notification->save();
               
                
            }
            
 
        }else{
            
            $likeRows=mylike::where('content_id',$post_id)->get();
            
            $alreadyLike=false;
            $rowNo=0;
            $tempCount=0;
            $key=0;
            
            foreach ($likeRows as $row){
                
                $likesArrTemp=json_decode($row->likes,true);
                
                $user_ids=array_column($likesArrTemp,"user_id");
                
                if(in_array( $user_id, $user_ids)){
                    $alreadyLike=true;
                    $key=array_search($user_id, $user_ids);
                    $rowNo=$tempCount;
                    $likesArr=$likesArrTemp;
                }else{
                    $tempCount++;
                }
            }    
 
            
            if($alreadyLike){
                
                //make dislike post
                        
                array_splice($likesArr, $key, 1);
                $likes_string=json_encode($likesArr);
                   
                DB::table('mylikes')
                    ->updateOrInsert(
                    	['content_id'=>$post_id,'rowNo'=>$rowNo],
                        [
                    	            
                    	   'content_id'=>$post_id,
                    	   'likes'=>$likes_string
                    	]
                );
                    
                    
                post::where('post_id',$post_id)
                    ->update([
                        'post_like'=>DB::raw('post_like-1')
                    
                ]);
            
                notification::where('post_id',$post_id)
                    ->where('writer_id',$user_id)
                    ->where('action',5)
                    ->delete();
               
                        
            }else{
                    // make like post
                        
                post::where('post_id',$post_id)
                    ->update([
                        'post_like'=>DB::raw('post_like+1')
                        
                ]);
 
                $postOwner_id =post::where('post_id',$post_id)->get();
                $postOwner_id=$postOwner_id[0]['learner_id'];
                        
                if($user_id!=$postOwner_id){
                
                    $notification=new Notification;
                    $notification->post_id=$post_id;
                    $notification->comment_id=0;
                    $notification->owner_id=$postOwner_id;
                    $notification->writer_id=$user_id;
                    $notification->action=5;
                    $notification->time=$time;
                    $notification->seen=0;
                    $notification->save();
                    
                    
                }
                
                $likeCount=post::where('post_id',$post_id)->get('post_like')->first();
                $likeCount=$likeCount->post_like;
                
                $rowNo=round($likeCount/2000);
                 
                $likeRow=mylike::where('content_id',$post_id)
                            ->where('rowNo',$rowNo)
                            ->get()->first();
                if($likeRow!=null){
                     $likesArr=json_decode($likeRow->likes,true);
                }
                
                $arr['user_id']=$user_id;
                $likesArr[]=$arr;
                $likes_string=json_encode($likesArr);
                
                DB::table('mylikes')
                    ->updateOrInsert(
                    	  ['content_id'=>$post_id,'rowNo'=>$rowNo],
                    	  [
                    	            
                    	    'content_id'=>$post_id,
                    	    'likes'=>$likes_string,
                    	    'rowNo'=>$rowNo
                    	   ]
                );
                        
            }
            
           
        }
        
        $likeCountNow=post::where('post_id',$post_id)->get('post_like')->first();
        $myArr['count']=$likeCountNow->post_like;
        $myArr['isLike']=$alreadyLike;
        return $myArr;
        
    }
   
    public function fetchPostLikes(Request $req,$major){
        
        $mCode=$req->mCode;
        $postId=$req->contentId;
        $count=$req->page;
        $major=$mCode."_user_datas";
        
        if($count<2){
            
            $likeRows=mylike::where('content_id',$postId)->get();
           
            foreach($likeRows as $likeRow){

                $likesArr=json_decode($likeRow->likes,true);
                $user_ids=array_column($likesArr,"user_id");
                foreach( array_reverse($user_ids) as $user_id){
                    $user=DB::table('learners')
                                ->selectRaw("
                        learners.learner_phone as userId,
                        learners.learner_name as userName,
                        learners.learner_image as userImage,
                        $major.is_vip as vip
                    ")
                     ->where('learners.learner_phone',$user_id)
                     ->join($major,$major.'.phone','=','learners.learner_phone')
                     ->limit(1)
                     ->get()
                     ->first();
                    if($user!=null){
                        $arr[]=$user;
                       
                    }
                }
            }
            $response['likes']=$arr;
            return $response;
        }
    }
    
    
    public function addSongLike(Request $req){
        
        
        $user_id=$req->user_id;
        $post_id=$req->post_id;
        $time=round(microtime(true)*1000);
        
        $likeCheck=mylike::where('content_id',$post_id)->get();
        $rowCount=$likeCheck->count();
        
        if($rowCount==0){
        
            $arr['user_id']=$user_id;
            $arr2[]=$arr;
			$likes=json_encode($arr2);
			
			
			DB::table('mylikes')
    	        ->updateOrInsert(
    	        ['content_id'=>$post_id],
    	        [
    	            
    	            'content_id'=>$post_id,
    	            'likes'=>$likes,
    	            'rowNo'=>0
    	       ]
    	   );
    	   
    	    Song::where('song_id',$post_id)
            ->update([
                'like_count'=>DB::raw('like_count+1')
            
            ]);
 
            
 
        }else{
            
            $likeRows=mylike::where('content_id',$post_id)->get();
            
            $alreadyLike=false;
            $rowNo=0;
            $tempCount=0;
            $key=0;
            
            foreach ($likeRows as $row){
                
                $likesArrTemp=json_decode($row->likes,true);
                
                $user_ids=array_column($likesArrTemp,"user_id");
                
                if(in_array( $user_id, $user_ids)){
                    $alreadyLike=true;
                    $key=array_search($user_id, $user_ids);
                    $rowNo=$tempCount;
                    $likesArr=$likesArrTemp;
                }else{
                    $tempCount++;
                }
            }    
 
            
            if($alreadyLike){
                
                //make dislike post
                        
                array_splice($likesArr, $key, 1);
                $likes_string=json_encode($likesArr);
                   
                DB::table('mylikes')
                    ->updateOrInsert(
                    	['content_id'=>$post_id,'rowNo'=>$rowNo],
                        [
                    	            
                    	   'content_id'=>$post_id,
                    	   'likes'=>$likes_string
                    	]
                );
                    
                    
                Song::where('song_id',$post_id)
                    ->update([
                        'like_count'=>DB::raw('like_count-1')
                    
                ]);
            
            
               
                        
            }else{
                    // make like post
                        
                Song::where('song_id',$post_id)
                    ->update([
                        'like_count'=>DB::raw('like_count+1')
                        
                ]);
 
                        
                
                $likeCount=Song::where('song_id',$post_id)->get('like_count')->first();
                $likeCount=$likeCount->like_count;
                
                $rowNo=round($likeCount/10000);
                 
                $likeRow=mylike::where('content_id',$post_id)
                            ->where('rowNo',$rowNo)
                            ->get()->first();
                if($likeRow!=null){
                     $likesArr=json_decode($likeRow->likes,true);
                }
                
                $arr['user_id']=$user_id;
                $likesArr[]=$arr;
                $likes_string=json_encode($likesArr);
                
                DB::table('mylikes')
                    ->updateOrInsert(
                    	  ['content_id'=>$post_id,'rowNo'=>$rowNo],
                    	  [
                    	            
                    	    'content_id'=>$post_id,
                    	    'likes'=>$likes_string,
                    	    'rowNo'=>$rowNo
                    	   ]
                );
                        
            }
            
           
        }
        
    }
    
    
    
}
