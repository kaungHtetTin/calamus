<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WordOfTheDayController extends Controller
{
  
    public function getEnglishWordOfTheday(){
        
        $thisDay =date('j');
        $saveDay=DB::table('Timer')->value('day');
        $fetchId=DB::table('Timer')->value('english');
        
        
        if($thisDay==$saveDay){
            $word=DB::table('WordOfDay')
            ->where('id',$fetchId)
            ->get();
            
            return $word;
            
        }else{
           $fetchId++;
           $affected =DB::table('Timer')
           ->update(
               [
                    'korea'=>DB::raw('korea+1'),
                    'english'=>DB::raw('english+1'),
                    'day'=>$thisDay
               ]
               );
            
            $word=DB::table('WordOfDay')
            ->where('id',$fetchId)
            ->get();
            
            if(!sizeof($word)==0){
                 return $word;  
            }else{
                $fetchId=1;
                DB::table('Timer')
                ->update(['english'=>$fetchId]);
                 $word=DB::table('WordOfDay')
                ->where('id',$fetchId)
                ->get();
                return $word;
            }
        }
        
    }
     
    public function getKoreaWordOfTheDay(){
        $thisDay =date('j');
        $saveDay=DB::table('Timer')->value('day');
        $fetchId=DB::table('Timer')->value('korea');
        
        
        if($thisDay==$saveDay){
            $word=DB::table('ko_word_of_days')
            ->where('id',$fetchId)
            ->get();
            
            return $word;
            
        }else{
           $fetchId++;
           $affected =DB::table('Timer')
           ->update(
               [
                    'korea'=>DB::raw('korea+1'),
                    'english'=>DB::raw('english+1'),
                    'day'=>$thisDay
               ]);
            
            $word=DB::table('ko_word_of_days')
            ->where('id',$fetchId)
            ->get();
            
            if(!sizeof($word)==0){
                 return $word;  
            }else{
                $fetchId=1;
                DB::table('Timer')
                ->update(['korea'=>$fetchId]);
                 $word=DB::table('ko_word_of_days')
                ->where('id',$fetchId)
                ->get();
                return $word;
            }
        }
    }
    
    public function getKoreanWordOfTheDayLists(Request $req){
        $count=$req->count;
        $words=DB::table('ko_word_of_days')
        ->offset($count)
        ->limit(50)
        ->orderBy('id','desc')
        ->get();
        
        return $words;
    }
}
