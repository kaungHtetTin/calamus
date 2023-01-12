<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\App;
use App\Models\Pricing;
use App\Models\Learner;
use App\Models\Teacher;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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

    // api route 

    function getHome(){
        $courseCategories=CourseCategory::get();

        $courses=Course::limit(6)->get();

        
        $courses=DB::table('courses')
            ->selectRaw("
                    *
                ")
            ->join('teachers','teachers.id','=','courses.teacher_id')
            ->limit(6)
            ->get();
        
        $totalStudent=Learner::count();
        $totalTeacher=Teacher::count();
        $totalCourse=Course::count();
        $teachers=Teacher::get();

        

        $response['categories']=$courseCategories;
        $response['courses']=$courses;
        $response['teachers']=$teachers;

        $response['general']['total_student']=$totalStudent;
        $response['general']['total_teacher']=$totalTeacher;
        $response['general']['total_course']=$totalCourse;

        return $response;
    }


}
