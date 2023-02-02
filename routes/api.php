<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GameWordController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\EnglishUserDataController;
use App\Http\Controllers\KoreanUserDataController;
use App\Http\Controllers\ChineseUserDataController;
use App\Http\Controllers\JapaneseUserDataController;
use App\Http\Controllers\RussianUserDataController;
use App\Http\Controllers\WordOfTheDayController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AnouncementController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FirebaseNotiPushController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SpeakingController;
use App\Http\Controllers\RatingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//course routing
Route::post('/{major}/start/course',[CourseController::class,'startACourse']);
Route::get('/{major}/courses/started',[CourseController::class,'getStartedCourse']);
Route::get('/{major}/course/enroll',[CourseController::class,'getCourseEnrollData']);
Route::get('/{major}/course/reviews',[CourseController::class,'getReviews']);

//rating routes
Route::post('/{major}/rates',[RatingController::class,'addRating']);
Route::post('/{major}/rates/delete',[RatingController::class,'deleteRating']);
Route::get('/{major}/rates',[RatingController::class,'getRating']);

//studying routing
Route::post('/{major}/studyalesson',[UserDataController::class,'studyALesson']);
Route::post('/{major}/setstudytime',[UserDataController::class,'setStudyTime']);

//lesson routing
Route::get('/{major}/lessons',[LessonController::class,'fetchLessons']);
Route::get('/{major}/lessons/video',[LessonController::class,'fetchVideos']);
Route::get('/{major}/lessons/search/video',[LessonController::class,'findAVideo']);
Route::get('/{major}/lessons/dayplan',[LessonController::class,'getDayPlan']);
Route::get('/{major}/lessons/category',[CourseController::class,'getCategoryByCourse']);
Route::get('/{major}/lessons-by-day',[LessonController::class,'getLessonsByDayPlan']);


//announcement routing
Route::get('/{major}/announcement',[AnouncementController::class,'getAnouncementLink']);

//post routing
Route::get('/{major}/posts',[PostController::class,'fetchPost']);
Route::get('/{major}/posts/user',[PostController::class,'fetchDiscussion']);
Route::get('/{major}/posts/user-share',[PostController::class,'fetchDiscussion2']);
Route::post('/{major}/posts/add',[PostController::class,'addPost']);
Route::post('/{major}/posts/delete',[PostController::class,'deletePost']);
Route::post('/{major}/posts/report',[PostController::class,'reportPost']);
Route::post('/{major}/posts/viewcount',[PostController::class,'getAndUpdateViewCount']);
Route::post('/{major}/posts/edit',[PostController::class,'editPost']);
Route::get('/{major}/posts/videourl',[PostController::class,'getVideodownloadLink']);
Route::get('/{major}/posts/share-content',[PostController::class,'getShareContent']);
Route::post('/{major}/posts/hide',[PostController::class,'hidePost']);
 

//comment routing
Route::get('/{major}/comments',[CommentController::class,'fetchComment']); //comment time =notificatio time(0 for commentactivity)
Route::post('/{major}/comments/add',[CommentController::class,'addComment']);
Route::post('/{major}/comments/reply',[CommentController::class,'addReply']);
Route::post('/{major}/comments/delete',[CommentController::class,'deleteComment']);

//like routing
Route::post('/{major}/comments/like',[LikeController::class,'addCommentLike']);
Route::get('/{major}/comments/likes',[LikeController::class,'fetchCommentsLikes']);
Route::post('/{major}/posts/like',[LikeController::class,'addPostLike']);
Route::get('/{major}/posts/likes',[LikeController::class,'fetchPostLikes']);
Route::post('/{major}/songs/like',[LikeController::class,'addSongLike']);

//song routing
Route::get('/{major}/songs',[SongController::class,'getSong']);
Route::get('/{major}/songs/search',[SongController::class,'searchASong']);
Route::get('/{major}/songs/popular',[SongController::class,'getPopularSong']);
Route::get('/{major}/songs/by/artist',[SongController::class,'getSongByArtist']);
Route::get('/{major}/songs/by/artist/popular',[SongController::class,'getPopularSongByArtist']);

Route::get('/{major}/songs/lyrics/{url}', function ($major,$url) {
    $url="../uploads/songs/lyrics/".$url.".txt";
    return readfile($url);
});
Route::post('/{major}/songs/download',[SongController::class,'downloadSong']);
Route::get('/{major}/songs/artists',[SongController::class,'getArtist']);



//user routing
Route::get('/{major}/search',[LearnerController::class,'searchSomeone']);
Route::post('/{major}/learners/block',[LearnerController::class,'blockUser']);
Route::post('/{major}/learners/unblock',[LearnerController::class,'unblockUser']);
Route::get('/{major}/learners/unblock',[LearnerController::class,'unblockUser']);
Route::get('/{major}/learners/block',[LearnerController::class,'getBlockUsers']);



//password reset
Route::get('/{major}/searchaccount',[PasswordController::class,'searchAccount']);
Route::get('/{major}/emailverify',[PasswordController::class,'verifyEmail']);
Route::post('/{major}/resetpasswordbycode',[PasswordController::class,'resetPasswordByCode']);
Route::get('/{major}/checkpassword',[PasswordController::class,'checkCurrentPassword']);
Route::post('/{major}/resetpasswordbyuser',[PasswordController::class,'resetPasswordByUser']);

//friend routing
Route::post('/{major}/addfriend',[FriendController::class,'addFriend']);
Route::post('/{major}/confirmfriend',[FriendController::class,'confrimFriend']);
Route::post('/{major}/unfriend',[FriendController::class,'unfriend']);
Route::post('/{major}/removefriendrequest',[FriendController::class,'RemoveFriendRequest']);
Route::get('/{major}/getfriends',[FriendController::class,'getFriends']);
Route::get('/{major}/getfriendrequests',[FriendController::class,'getFriendRequests']);

//notification routing
Route::get('/{major}/notifications',[NotificationController::class,'fetchNotification']);
Route::post('/{major}/pushnotification',[FirebaseNotiPushController::class,'pushNotificationToSingleUser']);
Route::post('/{major}/pushnotification/topic',[FirebaseNotiPushController::class,'pushNotificationToTopic']);

//game routing
Route::get('/{major}/gamers',[LearnerController::class,'getTopGamer']);
Route::get('/{major}/gameword',[GameWordController::class,'getGameWord']);

//easy English App
Route::get('/english/wordofdays',[WordOfTheDayController::class,'getEnglishWordOfTheday']);
Route::get('/english/credit',function(){return view('anouncement.englishcredit');});
Route::post('/english/gamers/scores/update',[EnglishUserDataController::class,'updateGameScore']);
Route::post('/{major}/click/english',[EnglishUserDataController::class,'recordAClickOnEnglish']); //only used for song in new version
// speaking chat bot
Route::get('/{major}/getdialogues',[SpeakingController::class,'getDialogue']);
Route::get('/{major}/chatbot/level',[SpeakingController::class,'getCurrentLevel']);
Route::get('/{major}/chatbot/saturations',[SpeakingController::class,'getSaturation']);
Route::post('/{major}/chatbot/updatelevel',[SpeakingController::class,'updateLevel']);
Route::post('/{major}/chatbot/recorderrorspeech',[SpeakingController::class,'recordErrorSpeech']);




//easy Korea app
Route::get('/korea/wordofdays',[WordOfTheDayController::class,'getKoreaWordOfTheDay']);
Route::post('/korea/gamers/scores/update',[KoreanUserDataController::class,'updateGameScore']);
Route::post('/{major}/click/korean',[KoreanUserDataController::class,'recordAClickOnKorea']);

//Easy Chinese
Route::get('/chinese/wordofdays',[WordOfTheDayController::class,'getChineseWordOfTheDay']);
Route::post('/chinese/gamers/scores/update',[ChineseUserDataController::class,'updateGameScore']);
Route::post('/{major}/click/chinese',[ChineseUserDataController::class,'recordAClickOnChinese']);

// Easy Japanese
Route::get('/japanese/wordofdays',[WordOfTheDayController::class,'getJapaneseWordOfTheDay']);
Route::post('/japanese/gamers/scores/update',[JapaneseUserDataController::class,'updateGameScore']);
Route::post('/{major}/click/japanese',[JapaneseUserDataController::class,'recordAClickJapanese']);

// Easy Russian
Route::get('/russian/wordofdays',[WordOfTheDayController::class,'getRussianWordOfTheDay']);
Route::post('/russian/gamers/scores/update',[RussianUserDataController::class,'updateGameScore']);
Route::post('/{major}/click/russian',[RussianUserDataController::class,'recordAClickRussian']);


//there are common routes

Route::post('/{major}/signup',[LearnerController::class,'signUp']);
Route::get('/{major}/checkaccount',[LearnerController::class,'checkAccount']);
Route::post('/{major}/login',[LearnerController::class,'logIng']);
Route::post('/{major}/login/data',[LearnerController::class,'loadUserData']);
Route::get('/{major}/login/data',[LearnerController::class,'loadUserData']);
Route::post('/{major}/editprofile',[LearnerController::class,'editProfile']);
Route::post('/{major}/coverphoto',[LearnerController::class,'changeCoverPhoto']);
Route::post('/{major}/updatebio',[LearnerController::class,'changeBio']);
Route::get('/{major}/getprofile/{userId}',[LearnerController::class,'getProfileData']);
Route::get('/{major}/getprofile/{myId}/{otherId}',[LearnerController::class,'getUserProfile']);


Route::post('/exam/result/update',[ExamController::class,'updateExamResult']);
Route::get('/{major}/login/data',[LearnerController::class,'loadUserData']);


//app ads routing
Route::get('/{major}/appads/{page}',[AppController::class,'getAppAds']);
Route::post('/{major}/appads/click',[AppController::class,'clickAds']);
Route::get('/apps',[AppController::class,'getApps']);

//app form routing
Route::get('/{major}/appform',[CourseController::class,'getAppForm']);

//app routing

Route::get('{major}/playvideo/{id}',function($major,$id){
    return view("anouncement.videoplay",[
            'id'=>$id
        ]);
});

Route::get('/{major}/vimeo',[LessonController::class,'loadPlayer']);

Route::get('/{major}/form', function ($major) {
    return file_get_contents(base_path('resources/lang/'.$major.'form.json'));
});
Route::get('/{major}/payment',function($major){
   return view("payment.$major"); 
});
Route::get('/{major}/version',function($major){
   return view("version.$major"); 
});




