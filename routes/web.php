<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\AnouncementController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\RequestedSongController;
use App\Http\Controllers\StudyPlanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//getMaterialLesson
Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/home',[LessonController::class,'koreaHome'])->name('home');
Route::get('/lesson/korea/{category}',[LessonController::class,'koreaLessonList'])->name('korealessonlist');
Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/material/{category}',[LessonController::class,'getMaterialLesson'])->name('material');

Route::get('/lesson',[LessonController::class,'getLesson'])->name('lesson');

Route::get('/lesson/{id}',[LessonController::class,'showLessonDetail'])->name('detailactivity');

Route::get('/video/{id}',[LessonController::class,'showVideo'])->name('videoactivity');

Route::get('/posts/',[PostController::class,'fetchPost']);


//Routing for anouncements
Route::get('/anounce/song/{userid}',[AnouncementController::class,'showSongAnouncement']);
Route::get('/anounce/englishone/{userid}',[AnouncementController::class,'showEnglishOne']);
Route::post('/anounce/englishone/{userid}',[AnouncementController::class,'voteEnglishOne'])->name('voteEnglishOne');
Route::get('/anounce/test/{userid}',[AnouncementController::class,'showTestAnouncement']);
Route::post('/anounce/song/{userid}',[AnouncementController::class,'requestSong'])->name('songRequest');
Route::post('/songs/vote/{userid}',[RequestedSongController::class,'voteASong'])->name("voteASong");
Route::get('/anounce/advertist/english/{userid}',[AnouncementController::class,'advertiseEasyEnglish']);
Route::get('/anounce/advertist/korea/{userid}',[AnouncementController::class,'advertiseEasyKorean']);
Route::get('/anounce/englishtwo/{userid}',function(){
   return view('anouncement.ano.englishtwo'); 
});

Route::get('/artists/{nation}',[ArtistController::class,'getArtist']);
Route::get('/artists/request/{id}',[RequestedSongController::class,'getRequestSong'])->name("requestedSongList");
Route::post('/songs/request/{id}',[RequestedSongController::class,'requestSong'])->name("requestSong");
Route::get('/songs/mostvoted/{nation}',[RequestedSongController::class,'getMostVotedSong'])->name("getMostVotedSong");

//activity 
Route::get('/activity/korea',[AnouncementController::class,'activityOfKoreaUsers']);
Route::get('/activity/english',[AnouncementController::class,'activityOfEnglishUsers']);
Route::get('/activity/korea/reward/{userid}',[AnouncementController::class,'koreaRewardedUser']);

//exam


Route::get('/exam/english/',[ExamController::class,'showEnglishExam']);
Route::get('/exam/english/leveltest/{test}',[ExamController::class,'showEnglishLevelTest'])->name('showEnglishLevelTest');

Route::get('/exam/korea',[ExamController::class,'showKoreaExam']);
Route::get('/exam/korea/basic/{test}',[ExamController::class,'showKoreaBasicCourseExam'])->name('showKoreaBasicCourseExam');

Route::get('/studyplan/korea',[StudyPlanController::class,'showKoreaStudyPlan']);
Route::get('/studyplan/english',[StudyPlanController::class,'showEnglishStudyPlan']);
Route::get('/studyplan/korea/detail',[StudyPlanController::class,'studyPlanDetail'])->name('studyPlanDetail');

Route::get('/english/credit',function(){
     return view('anouncement.englishcredit');
});



 












