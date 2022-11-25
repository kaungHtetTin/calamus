<?php

namespace App\Http\Controllers;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function getAppAds(){
        $app=App::inRandomOrder()->first();
        return $app;
    }
    
    public function clickAds(Request $req){
        $id=$req->id;
        
        
        App::where('id', $id)
        ->update([
              'click'=>DB::raw('click+1')
        ]);
        
    }
    
    public function getApps(){
        $app=App::where('type','install')->get();
        return $app;
    }
}
