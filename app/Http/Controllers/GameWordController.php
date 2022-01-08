<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoreanGameWord;
use App\Models\EnglishGameWord;
use Illuminate\Support\Facades\DB;

class GameWordController extends Controller
{ 
    public function getGameWord(Request $req,$major){
        
        $mCode=$req->mCode;
        
        $mCode=$mCode."_game_words";
        $gameWord=DB::table($mCode)->orderByRaw("RAND()")->limit(1)->get();

        return $gameWord;
    }
}
