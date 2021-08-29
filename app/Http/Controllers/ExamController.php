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
  
  public function checkEnglishLevelTestOne(Request $req,$userid){
      
    $rightAnswers = [ 'a', 'a', 'c', 'd', 'b', 'b', 'a', 'c', 'd', 'b', 'b', 'b', 'a', 'b', 'a', 'a', 'c', 'a', 'c', 'b', 'b', 'a', 'b', 'a', 'a' ];
    $answers = [];        
    $result = 0;
    
    for ($i=0; $i < count($rightAnswers); $i++) { 
        $key="answer".($i+1);
        if($rightAnswers[$i] == $req->$key){
            $result += 1;
        }
    }
    
    if($result>=0 and $result<=7){
        $level="Your are basic level.";
    }else if($result>=8 and $result<=13){
        $level = "You are elementary level.";
    }else if($result>=14 and $result<=20){
        $level = "You are pre-intermediate level.";
    }else{
        $level= "You are intermediate level";
    }
    
    
    EnglishUserData::where('phone',$userid)->update(['level_test'=>$result]);
    return view('exams.english.leveltest.result1',[
            'level'=>$level,
            'result'=>$result
        ]);
  }
}
