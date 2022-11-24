<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\App;
use App\Models\Pricing;

use Illuminate\Http\Request;

class MainController extends Controller
{
    function index(){

        $courses = Course::where('major','korea')->orwhere('major','english')->get();
        $apps=App::where('show_on',1)->get();
         
        return view('main.index',[
            'courses'=>$courses,
            'apps'=>$apps
            
        ]);
    }

    function viewPlatform($id){
        $app=App::find($id);
        $courses = Course::where('major',$app->major)->get();
        $pricing=Pricing::where('app_id',$id)->first();
       
        return view('main.app',[
            'courses'=>$courses,
            'app'=>$app,
            'pricing'=>$pricing->pricing
        ]);
    }
}
