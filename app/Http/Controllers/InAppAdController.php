<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InAppAdController extends Controller
{
    public function showInAppAds(Request $req,$major){
        $id=1;    
        $view ="inappads.$major.inappads".$id;
        return view($view);
    }
    
    
    public function showEnglishInAppAds(Request $req){
        $id=1;    
        $view ='inappads.english.inappads'.$id;
        return view($view);
    }
    
    public function showChineseInAppAds(Request $req){
        $id=1;    
        $view ='inappads.chinese.inappads'.$id;
        return view($view);
    }
    
}
