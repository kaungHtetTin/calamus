<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KoreanUserData;

class KoreanUserDataController extends Controller
{
    public function updateGameScore(Request $req){
       $score=$req->score;
	   $phone=$req->phone;
	   
	   KoreanUserData::where('phone', $phone)
        ->update([
          'game_score'=>$score
        ]);
        
    }
    
    public function recordAClickOnKorea(Request $req){
        $userId=$req->user_id;
        $record=$req->record;
        
        KoreanUserData::where('phone',$userId)
            ->update([
                $record=>DB::raw("$record+1")
            
        ]);
        
        KoreanUserData::where('phone',$userId)
            ->update([
                'learn_count'=>DB::raw("learn_count+1")
            
        ]);
        
        $data=KoreanUserData::where('phone',$userId)->get();
        return $data;
    }
}
