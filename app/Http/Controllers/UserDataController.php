<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EnglishUserData;
use App\Models\KoreanUserData;
use App\Models\study;

class UserDataController extends Controller
{
    public function updateGameScore(Request $req){
       $score=$req->score;
	   $phone=$req->phone;
	   
	   EnglishUserData::where('phone', $phone)
        ->update([
          'game_score'=>$score
        ]);
        
    }
    
    public function recordAClickOnEnglish(Request $req){
        $userId=$req->user_id;
        $record=$req->record;
        
       
        EnglishUserData::where('phone',$userId)
            ->update([
                $record=>DB::raw("$record+1")
            
        ]);
        
        EnglishUserData::where('phone',$userId)
            ->update([
                'learn_count'=>DB::raw("learn_count+1")
            
        ]);
        
        $data=EnglishUserData::where('phone',$userId)->get();
        return $data;
    }
    
    public function studyALesson(Request $req){
        $userId=$req->userId;
        $lessonId=$req->lessonId;
        
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
        
        return "success";
    }
    
    public function setStudyTime(Request $req,$major){
        
        $majorCode=$req->mCode;
        $phone=$req->userId;
        $studyTime=$req->studyTime;
        $joinTable=$majorCode."_user_datas";
        
        DB::table("$joinTable")->where("phone",$phone)->update(["study_time"=>$studyTime]);
        return "success";
    }
    
   
}
