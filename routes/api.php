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
use App\Http\Controllers\WordOfTheDayController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AnouncementController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FirebaseNotiPushController;
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


//these routes are used for easy English App
Route::post('/login/english',[LearnerController::class,'easyEnglishLogin']);
Route::get('/posts/english',[PostController::class,'fetchEnglishPost']);
Route::post('/comments/english',[CommentController::class,'fetchCommentEnglish']);
Route::get('/wordofdays/english',[WordOfTheDayController::class,'getEnglishWordOfTheday']);
Route::get('/notifications/english',[NotificationController::class,'fetchEnglishNotification']);
Route::get('/game/english',[GameWordController::class,'getEngilshGameWord']);
Route::get('/gamers/english/scores',[LearnerController::class,'getEnglishTopGamer']);
Route::post('/gamers/english/scores/update',[EnglishUserDataController::class,'updateGameScore']);
Route::post('/click/english',[EnglishUserDataController::class,'recordAClickOnEnglish']);

Route::get('/form/english', function () {

    return file_get_contents(base_path('resources/lang/englishform.json'));
});

//these routes are used for easy Korea app
Route::get('/posts/korean',[PostController::class,'fetchKoreanPost']);

Route::get('/posts/korean/T',[PostController::class,'fetchKoreanPostT']);

Route::post('/comments/korean',[CommentController::class,'fetchCommentKorean']);
Route::get('/notifications/korean',[NotificationController::class,'fetchKoreanNotification']);
Route::get('/game/korean',[GameWordController::class,'getKoreanGameWord']);
Route::get('/gamers/korean/scores',[LearnerController::class,'getKoreanTopGamer']);
Route::post('/gamers/korean/scores/update',[KoreanUserDataController::class,'updateGameScore']);
Route::get('/wordofdays/korean',[WordOfTheDayController::class,'getKoreaWordOfTheDay']);
Route::post('/login/korean',[LearnerController::class,'koreanLogin']);
Route::post('/click/korean',[KoreanUserDataController::class,'recordAClickOnKorea']);


//there are common routes

Route::post('/signup',[LearnerController::class,'signUp']);
Route::post('/login',[LearnerController::class,'logIng']);
Route::post('/editprofile',[LearnerController::class,'editProfile']);
Route::get('/getprofile',[LearnerController::class,'getProfileData']);
Route::get('/getprofile/{myId}/{otherId}/{major}',[LearnerController::class,'getUserProfile']);
Route::get('/peopleyoumayknow/{myId}/{major}',[LearnerController::class,'peopleYouMayKnow']);
Route::get('/search/{major}/{search}',[LearnerController::class,'searchSomeone']);

//password reset
Route::get('/searchaccount/{phone}/{major}',[PasswordController::class,'searchAccount']);
Route::get('/emailverify/{phone}/{code}',[PasswordController::class,'verifyEmail']);
Route::get('/resetpasswordbycode/{phone}/{code}/{password}',[PasswordController::class,'resetPasswordByCode']);
Route::get('/checkpassword/{phone}/{password}',[PasswordController::class,'checkCurrentPassword']);
Route::get('/resetpasswordbyuser/{phone}/{currentPassword}/{newPassword}',[PasswordController::class,'resetPasswordByUser']);

Route::get('/posts/special',[PostController::class,'fetchDiscussion']);
Route::get('/lessons',[LessonController::class,'fetchLessons']);
Route::get('/lessons/video',[LessonController::class,'fetchVideos']);
Route::get('/lessons/video/find',[LessonController::class,'findAVideo']);

Route::post('/comments/add',[CommentController::class,'addComment']);
Route::post('/comments/delete',[CommentController::class,'deleteComment']);
Route::post('/comments/like',[LikeController::class,'addCommentLike']);
Route::get('/comments/likes',[LikeController::class,'fetchCommentsLikes']);

Route::get('/songs/get',[SongController::class,'getSong']);
Route::get('/songs/popular',[SongController::class,'getPopularSong']);
Route::post('/songs/like',[LikeController::class,'addSongLike']);
Route::post('/songs/download',[SongController::class,'downloadSong']);
Route::get('/songs/search',[SongController::class,'searchASong']);
Route::get('/songs/artists',[SongController::class,'getArtist']);
Route::get('/songs/{artist}',[SongController::class,'getSongByArtist']);
Route::get('/songs/popular/{artist}',[SongController::class,'getPopularSongByArtist']);

Route::post('/posts/add',[PostController::class,'addPost']);
Route::post('/posts/delete',[PostController::class,'deletePost']);
Route::post('/posts/report',[PostController::class,'reportPost']);
Route::post('/posts/viewcount',[PostController::class,'getAndUpdateViewCount']);
Route::post('/posts/edit',[PostController::class,'editPost']);
Route::post('/posts/like',[LikeController::class,'addPostLike']);
Route::get('/posts/likes',[LikeController::class,'fetchPostLikes']);
Route::get('/anouncement',[AnouncementController::class,'getAnouncementLink']);



Route::get('/form/korea', function () {

    return file_get_contents(base_path('resources/lang/koreaform.json'));
});

Route::get('/songs/lyrics/{url}', function ($url) {

    return file_get_contents("https://www.calamuseducation.com/uploads/songs/lyrics/".$url.".txt");
   
});

Route::get('/playvideo/{id}',function($id){
    return view("anouncement.videoplay",[
            'id'=>$id
        ]);
});

Route::get('/payment/korea',function(){
   return view("anouncement.koreapayment"); 
});



//Common Routes for admin
Route::get('/posts/report',[PostController::class,'fetchReportedPost']);
Route::post('/posts/report/remove',[PostController::class,'removePostFromReportList']);
Route::get('/wordofdays/korean/all',[WordOfTheDayController::class,'getKoreanWordOfTheDayLists']);
Route::post('/notificaltion/public/add',[NotificationController::class,'addPublicNotification']);
Route::post('/lesson/video/add',[LessonController::class,'addLesson']);
Route::get('/notifications/admin',[NotificationController::class,'fetchNotificationForAdmin']);
Route::post('anouncement/songadding',[AnouncementController::class,'addSongForWeeks']);

//friend controlling
Route::post('/addfriend',[FriendController::class,'addFriend']);
Route::post('/confirmfriend',[FriendController::class,'confrimFriend']);
Route::post('/unfriend',[FriendController::class,'unfriend']);
Route::post('/removefriendrequest',[FriendController::class,'RemoveFriendRequest']);
Route::get('/getfriends/{id}/{major}',[FriendController::class,'getFriends']);
Route::get('/getfriendreq/{id}/{major}',[FriendController::class,'getFriendRequests']);


Route::get('/unfriend',[FriendController::class,'unfriend']);
Route::get('/addfriend',[FriendController::class,'addFriend']);
Route::get('/confirmfriend',[FriendController::class,'confrimFriend']);

Route::post('/pushnotification',[FirebaseNotiPushController::class,'pushNotificationToSingleUser']);



