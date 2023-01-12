<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\App;
use App\Models\Pricing;

class CourseController extends Controller
{
    public function getCourses($category){
        if($category=='all'){
            $courses=Course::get();
        }else {
            $courses=Course::where('major',$category)->get();
        }

        return $courses;
    }
}
