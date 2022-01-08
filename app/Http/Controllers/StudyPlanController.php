<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KoreanUserData;
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
        
        $lessons =DB::table('study_plan')
                        ->selectRaw("
                            lessons.title as lesson_title,
                            category_title as course_title,
                            day
                        ")
                        ->join('lessons','lessons.id','=','study_plan.lesson_id')
                        ->join('lessons_categories','lessons.category_id','=','lessons_categories.id')
                        ->where('study_plan.course_id',$course)
                        ->orderby('day','asc')
                        ->orderby('study_plan.id','asc')
                        ->get();
      
        return view('studyplan.korea.plan',[
          'plans'=>$lessons
        ]);
    }
    
  
}
