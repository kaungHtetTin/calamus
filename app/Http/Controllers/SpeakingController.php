<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EnglishUserData;
use App\Models\ErrorSpeech;

class SpeakingController extends Controller
{
    public function getDialogue(Request $req){
        $phone=$req->phone;
        
        if(isset($req->level)){
            $level=$req->level;
        }else{
             $level=EnglishUserData::where('phone',$phone)->first()->speaking_level;
        }
        
        
        $dialogues=DB::table('ee_speakingtrainer')
        ->selectRaw(
            "*, ee_speakingtrainer.id as dialogueId"
            )
        ->where('ee_saturation.id',$level)
        ->join('ee_saturation','ee_saturation.saturation_id','=','ee_speakingtrainer.saturation_id')
        ->get();
        
        return $dialogues;
        
      
    }
    
    public function getCurrentLevel(Request $req, $major){
        $phone=$req->phone;
        $level=EnglishUserData::where('phone',$phone)->first()->speaking_level;
        
        $saturation=DB::table('ee_saturation')->where('id',$level)
        ->get();
        
        if(count($saturation)>0){
            $response['data']=$saturation;
            return $response;
        }else{
            $response['code']="1";
            return $response;
        }
    
        
    }
    
    public function updateLevel(Request $req,$major){
        $phone=$req->phone;
        EnglishUserData::where('phone',$phone)
            ->update([
                'speaking_level'=>DB::raw('speaking_level+1')
            
            ]);
         
        $level=EnglishUserData::where('phone',$phone)->first()->speaking_level;
        
         $dialogues=DB::table('ee_speakingtrainer')
        ->selectRaw(
            "*, ee_speakingtrainer.id as dialogueId"
            )
        ->where('ee_saturation.id',$level)
        ->join('ee_saturation','ee_saturation.saturation_id','=','ee_speakingtrainer.saturation_id')
        ->get();
        
      
        return $dialogues;
        
     
        
    }
    
    public function recordErrorSpeech(Request $req, $major){
        $phone=$req->phone;
        $speech_id=$req->speech_id;
        $error=$req->error_speech;
        
        $errorSpeech=new ErrorSpeech;
        $errorSpeech->speech_id=$speech_id;
        $errorSpeech->phone=$phone;
        $errorSpeech->error_speech=$error;
        $errorSpeech->save();
        
        return "success";
        
    }
    
    public function getSaturation(Request $req, $major){
        $phone=$req->phone;
        $level=EnglishUserData::where('phone',$phone)->first()->speaking_level;
        $saturations=DB::table('ee_saturation')->get();
        
        $response['saturation']=$saturations;
        $response['current_level']=$level;
        
        return $response;
    }
}
