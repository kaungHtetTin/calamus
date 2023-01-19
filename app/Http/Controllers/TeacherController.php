<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function getTeacherDetail($id){
        $teacher=Teacher::find($id);
        $courses=$teacher->courses;
        
        $response['teacher']=$teacher;
        return $teacher;
    }
}
