<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoreanGameWord;
use App\Models\EnglishGameWord;

class GameWordController extends Controller
{ 
    public function getKoreanGameWord(){
        $gameWord=KoreanGameWord::inRandomOrder()->first();
        return $gameWord;
    }
    
    public function getEngilshGameWord(){
        $gameWord=EnglishGameWord::inRandomOrder()->first();
        return $gameWord;
    }
}
