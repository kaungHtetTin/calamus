<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JapaneseUserData;

class ChineseUserDataController extends Controller
{
    public function updateGameScore(Request $req){
       $score=$req->score;
	   $phone=$req->phone;
	   
	   JapaneseUserData::where('phone', $phone)
        ->update([
          'game_score'=>$score
        ]);
        
    }
    
    //no longer use in new version and only used for song
    public function recordAClickOnJapanese(Request $req){
        $userId=$req->user_id;
        $record=$req->record;
        
       
        JapaneseUserData::where('phone',$userId)
            ->update([
                $record=>DB::raw("$record+1")
            
        ]);
        
        JapaneseUserData::where('phone',$userId)
            ->update([
                'learn_count'=>DB::raw("learn_count+1")
            
        ]);
        
        $data=JapaneseUserData::where('phone',$userId)->get();
        return $data;
    }
}
