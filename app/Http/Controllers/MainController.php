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

        $courses=DB::table('courses')
            ->selectRaw("
                    courses.title,courses.description,courses.fee,courses.background_color, courses.cover_url,courses.rating,
                    courses.duration,courses.rating,courses.lessons_count,
                    teachers.name,teachers.profile,teachers.total_course

                ")
            ->join('teachers','teachers.id','=','courses.teacher_id')
            ->limit(6)
            ->get();
        
        $totalStudent=Learner::count();
        $totalTeacher=Teacher::count();
        $totalCourse=Course::count();
        $teachers=Teacher::selectRaw("name,profile,rank")->get();

        

        $response['categories']=$courseCategories;
        $response['courses']=$courses;
        $response['teachers']=$teachers;

        $response['general']['total_student']=$totalStudent;
        $response['general']['total_teacher']=$totalTeacher;
        $response['general']['total_course']=$totalCourse;

        return $response;
    }

    public function getCoursePage(Request $req){
        if(isset($req->page)){
            $page=$req->page;
        }else{
            $page=1;
        }
     
        $page=$page-1;
        $count=10;
        $offset=$page*10;

        $courseCategories=CourseCategory::get();

        $courses=DB::table('courses')
            ->selectRaw("
                    *
                ")
            ->join('teachers','teachers.id','=','courses.teacher_id')
          
            ->offset($offset)
            ->limit($count)
            ->get();

        $popularCourses=DB::table('course_enroll')
            ->selectRaw("
                count(*)as enrolls,courses.course_id,courses.title,courses.fee,courses.cover_url,background_color
            ")
            ->join('courses','courses.course_id','=','course_enroll.course_id')
            ->groupBy("course_id")
            ->orderBy("enrolls","desc")
            ->limit(4)
            ->get();
        
        
        $response['categories']=$courseCategories;
        $response['courses']=$courses;
        $response['popular_courses']=$popularCourses;

        return $response;
            
    }

    public function getCourseDetailPage(Request $req,$courseId){
        
        if(isset($req->userid)){
            $userid=$req->userid;
        }else{
            $userid="000";
        }

        $course=Course::where('course_id',$courseId)->first();
        $cateogry=CourseCategory::where('keyword',$course->major)->first();
       
        
      
        $plans=DB::table('study_plan')
            ->selectRaw("
                lessons.id as lesson_id,
                lessons.title as lesson_title,
                lessons.duration,
                lessons.isVideo as is_Video,
                day,
                CASE
                WHEN  EXISTS (SELECT NULL FROM studies std 
                WHERE std.learner_id ='$userid'and std.lesson_id =study_plan.lesson_id) THEN 1
                ELSE 0
                END as learned
            ")
            ->join('lessons','lessons.id','=','study_plan.lesson_id')
            ->where('study_plan.course_id',$courseId)
            ->orderby('day','asc')
            ->orderby('study_plan.id','asc')
            ->get();
 
            
        for($i=0;$i<count($plans);$i++){
            $day=$plans[$i]->day;
            $day--;
           
            $lessons[$day][]=$plans[$i];
             
        }
        

        $response['course']=$course;
        $response['teacher']=$course->teacher;
        $response['category']=$cateogry;
        $response['curriculum']=$lessons;
        return $response;
    }

    public function getInstructorPage(){

        $teachers=Teacher::get();
        return $teachers;
    }


}
