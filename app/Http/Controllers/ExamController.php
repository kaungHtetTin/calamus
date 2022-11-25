<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KoreanUserData;
use App\Models\EnglishUserData;

class ExamController extends Controller
{
  public function showEnglishExam(Request $req){
  
      return view('exams.english.main',[
          'userid'=>$req->userid
          ]);
  }
  
    public function showEnglishLevelTest(Request $req, $test){
        $view ='exams.english.leveltest.leveltest'.$test;
        return view($view,[
          'userid'=>$req->userid
        ]);
    }
    
     public function showEnglishBasicTest(Request $req, $test){
        $view ='exams.english.basic.basicexam'.$test;
        return view($view,[
          'userid'=>$req->userid
        ]);
    }
  
  
    public function updateExamResult(Request $req){
        $major=$req->major;
        $test=$req->test;
        $userid=$req->userid;
        $result=$req->result;
        if($major=="english"){
            EnglishUserData::where('phone',$userid)->update([$test=>$result]);
        }else if($major=="korea"){
            KoreanUserData::where('phone',$userid)->update([$test=>$result]);
        }
     
        return "update successfully";
    }
  
  
    public function showKoreaExam(Request $req){
        return view('exams.korea.main',[
              'userid'=>$req->userid
        ]);
    }
    
    public function showKoreaBasicCourseExam(Request $req, $test){
      $view ='exams.korea.basic.basic'.$test;
      return view($view,[
          'userid'=>$req->userid
          ]);
    }
    
    public function showKoreaLevelOneCourseExam(Request $req, $test){
      $view ='exams.korea.levelone.levelone'.$test;
      return view($view,[
          'userid'=>$req->userid
          ]);
    }
}
