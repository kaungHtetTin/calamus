<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\NotificationPublic;

class NotificationController extends Controller
{
    public function fetchKoreanNotification(Request $req){
     $user_id=$req->user_id;
     $major="korea";
     
     $notis=DB::table('notification')
        ->selectRaw('
                
                learners.learner_name as writer_name,
                learners.learner_image as writer_image,
        	    ko_user_datas.is_vip as vip,
        	    posts.post_id,
        	    posts.body,
        	    posts.image,
        	    posts.has_video,
        	    notification.id,
        	    notification.time,
        	    notification.seen,
        	    notification.action,
        	    notification.comment_id,
        	    notification_action.action_name as takingAction

            ')
        ->where('posts.major',$major)
        ->where('notification.owner_id',$user_id)
        ->OrWhere('notification.owner_id','1001')
        ->join('posts','posts.post_id','=','notification.post_id')
        ->join('learners','learners.learner_phone','=','notification.writer_id')
        ->join('ko_user_datas','ko_user_datas.phone','=','learners.learner_phone')
        ->join('notification_action','notification_action.action','=','notification.action')
        ->orderBy('notification.time','desc')
        ->limit(100)
        ->get();

        
        return $notis;
        
    }
    
    public function fetchEnglishNotification(Request $req){
     $user_id=$req->user_id;
     $major="english";
     
     $notis=DB::table('notification')
        ->selectRaw('
                learners.learner_name as writer_name,
                learners.learner_image as writer_image,
        	    ee_user_datas.is_vip as vip,
        	    posts.post_id,
        	    posts.body,
        	    posts.image,
        	    posts.has_video,
        	    notification.id,
        	    notification.time,
        	    notification.seen,
        	    notification.action,
        	    notification.comment_id,
        	    notification_action.action_name as takingAction
                
            ')
        ->where('posts.major',$major)
        ->where('notification.owner_id',$user_id)
         ->OrWhere('notification.owner_id','1002')
        ->join('posts','posts.post_id','=','notification.post_id')
        ->join('learners','learners.learner_phone','=','notification.writer_id')
        ->join('ee_user_datas','ee_user_datas.phone','=','learners.learner_phone')
        ->join('notification_action','notification_action.action','=','notification.action')
        ->orderBy('notification.time','desc')
        ->limit(100)
        ->get();
        
        return $notis;
        
    }
    
    
    public function fetchNotificationForAdmin(Request $req){
        $user_id="10000";
        $major=$req->major;
        $notis=DB::table('notification')
            ->selectRaw('
                
                learners.learner_name as writer_name,
                learners.learner_image as writer_image,
        	    posts.post_id,
        	    posts.body,
        	    posts.image,
        	    posts.has_video,
        	    notification.id,
        	    notification.time,
        	    notification.seen,
        	    notification.action,
        	    notification.comment_id,
        	    notification_action.action_name as takingAction

            ')
        ->where('posts.major',$major)
        ->where('notification.owner_id',$user_id)
        ->where('notification.action','<','5')
        ->join('posts','posts.post_id','=','notification.post_id')
        ->join('learners','learners.learner_phone','=','notification.writer_id')
        ->join('notification_action','notification_action.action','=','notification.action')
        ->orderBy('notification.time','desc')
        ->limit(100)
        ->get();

        return $notis;
    }
    
    public function addPublicNotification(Request $req){
            $post_id=$req->post_id;
            $action=$req->action;
            $owner_id=$req->owner_id;
            
            $notification=new Notification;
            $notification->post_id=$post_id;
            $notification->comment_id=0;
            $notification->owner_id=$owner_id;
            $notification->writer_id='10000';
            $notification->action=$action;
            $notification->time=$post_id;
            $notification->seen=2;
            $notification->save();
    }
}
