<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RussianUserData;

class RussianUserDataController extends Controller
{
    public function updateGameScore(Request $req){
       $score=$req->score;
	   $phone=$req->phone;
	   
	   RussianUserData::where('phone', $phone)
        ->update([
          'game_score'=>$score
        ]);
        
    }
    
    //no longer use in new version and only used for song
    public function recordAClickOnRussian(Request $req){
        $userId=$req->user_id;
        $record=$req->record;
        
       
        RussianUserData::where('phone',$userId)
            ->update([
                $record=>DB::raw("$record+1")
            
        ]);
        
        RussianUserData::where('phone',$userId)
            ->update([
                'learn_count'=>DB::raw("learn_count+1")
            
        ]);
        
        $data=RussianUserData::where('phone',$userId)->get();
        return $data;
    }
}
