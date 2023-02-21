<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lesson;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    function getDetail($id){
        $lesson=lesson::find($id);
        $post=Post::where('post_id',$lesson->date)->first();

        $response['lesson']=$lesson;
        $response['post']=$post;
        return $response;
    }
}
