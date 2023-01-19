<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Learner;
use App\Models\Post;


class PostController extends Controller
{
    public function getBlogs(Request $req){

        if(isset($req->page)){
            $page=$req->page;
        }else{
            $page=1;
        }
 
        
        $limit=10;
        $count=($page-1)*$limit;
        
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
                posts.vimeo,
        	    posts.has_video
                ")
        ->where('posts.show_on_blog',1)
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->orderBy('posts.id','desc')
        ->offset($count)
        ->limit($limit)
        ->get();
        
        $response['blogs']=$posts;

        return $response;

    }

    public function getBlogPostDetail($id){
        $post=Post::where('post_id',$id)->first();
        $author=Learner::where('learner_phone',$post->learner_id)->first();
        $comments=DB::table('comment')
            ->selectRaw("
                learners.learner_name as userName,
        	    learners.learner_phone as userId,
        	    learners.learner_image as userProfile,
        	    comment.post_id as postId,
                comment.body,
                comment.image as commentImage,
                comment.time,
                comment.parent
                ")
        ->where('comment.post_id',$post->post_id)
        ->join('learners','learners.learner_phone','=','comment.writer_id')
        ->get();

        $response['post']=$post;
        $response['author']=$author;
        $response['comment']=$comments;

        return $response;
    }
    
}
