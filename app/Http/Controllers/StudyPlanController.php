<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KoreanUserData;
use App\Models\course;
use App\Models\EnglishUserData;

class StudyPlanController extends Controller
{
    public function showKoreaStudyPlan(Request $req){
  
        return view('studyplan.korea.index',[
          'userid'=>$req->userid
        ]);
    }
    
    public function showEnglishStudyPlan(Request $req){
  
        return view('studyplan.english.index',[
          'userid'=>$req->userid
        ]);
    }
    
   
    public function studyPlanDetail(Request $req){
        
        $userid=$req->userid;
        $course=$req->course;
        
        $course_detail=course::where('course_id',$course)->first();
    
        
        $plans=DB::table('study_plan')
            ->selectRaw("
               
                lessons.title as lesson_title,
                lessons.duration,
                day
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
       
        
        return view('studyplan.korea.plan',[
            'course'=>$course_detail,
            'plans'=>$lessons
        ]);
    }
    
  
}
