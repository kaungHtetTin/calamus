<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EnglishUserData;

class EnglishUserDataController extends Controller
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
        
        $data=EnglishUserData::where('phone',$userId)->get();
        return $data;
    }
}
