<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\weekSong;
use App\Models\anouncement;

class AnouncementController extends Controller

{
    
    public function getAnouncementLink(Request $req){
        $major=$req->major;
        $userId=$req->userId;
        
        $anounceData=DB::table('anouncement')
        ->selectRaw("
                anouncement.link as anounceLink,
                anouncement.is_seen
            ")
        ->where('anouncement.major',$major)
        ->get();
        
        foreach($anounceData as $data){
            $data->seen=0;
            $seenUsersArr=json_decode($data->is_seen,true);
            $user_ids=array_column($seenUsersArr,"user_id");
            
            if(in_array( $userId, $user_ids)){
                $data->seen=1;
            }
            
            $arr[]=$data;
            
        }
        
        return $arr;
        
    }
    
    public function showSongAnouncement($userid){
        $weekSongs=weekSong::where('major','korea')->get();
        
        return view('anouncement.song',[
            'userid'=>$userid,
            'weekSongs'=>$weekSongs
        
        ]);
    }
    
    public function showEnglishOne($userid){
        $weekSongs=weekSong::where('major','englishOne')->get();
        
        return view('anouncement.ano.englishone',[
            'userid'=>$userid,
            'weekSongs'=>$weekSongs
        
        ]);
    }
    

    
    public function addSongForWeeks(Request $req){
        $songOne=$req->songOne;
        $songTwo=$req->songTwo;
        $songThree=$req->songThree;
        
        DB::table('anouncement')->updateOrInsert(
                    	 ['id'=>1],
                    	 [
                    	       'is_seen'=>"[]"
                    	 ]
        );
        
        DB::table('weekSongs')->updateOrInsert(
                    	 ['id'=>1],
                    	 [
                    	       'song_name'=>$songOne,
                    	        'votes'=>0
                    	 ]
        );
        
        DB::table('weekSongs')->updateOrInsert(
                    	 ['id'=>2],
                    	 [
                    	       'song_name'=>$songTwo,
                    	       'votes'=>0
                    	 ]
        );
        DB::table('weekSongs')->updateOrInsert(
                    	 ['id'=>3],
                    	 [
                    	       'song_name'=>$songThree,
                    	        'votes'=>0
                    	 ]
        );
        
        return "Added";
        
    }
    
    public function requestSong(Request $req,$userid){
        
        $seenUsers=anouncement::where('id','1')->get()->first();
        $seenUsersArr=json_decode($seenUsers->is_seen,true);
        $arr['user_id']=$userid;
        $seenUsersArr[]=$arr;
        
        $seenUserArrString=json_encode($seenUsersArr);
        
        DB::table('anouncement')
                    ->updateOrInsert(
                    	  ['id'=>1],
                    	  [
                    	       'is_seen'=>$seenUserArrString
                    	   ]
            );
            
        weekSong::where('id',$req->songName)
                    ->update([
                        'votes'=>DB::raw('votes+1')
                        
                ]);
        
        return "Thanks for participating!";
    }
    
    public function voteEnglishOne(Request $req,$userid){
        
        $seenUsers=anouncement::where('id','3')->get()->first();
        $seenUsersArr=json_decode($seenUsers->is_seen,true);
        $arr['user_id']=$userid;
        $seenUsersArr[]=$arr;
        
        $seenUserArrString=json_encode($seenUsersArr);
        
        DB::table('anouncement')
                    ->updateOrInsert(
                    	  ['id'=>3],
                    	  [
                    	       'is_seen'=>$seenUserArrString
                    	   ]
            );
            
        weekSong::where('id',$req->songName)
                    ->update([
                        'votes'=>DB::raw('votes+1')
                        
                ]);
        
        return "Thanks for participating!";
    }
    
    
    public function activityOfKoreaUsers(Request $req){
        
        // the most login user
        $logins=DB::table('ko_user_datas')
            ->selectRaw("
                learner_name as name,
                learner_image as image
            ")
            ->join('learners','ko_user_datas.phone','=','learners.learner_phone')
            ->orderBy('login_time','desc')
            ->limit(10)->get();
        
        // the song favourate users
        $songs=DB::table('ko_user_datas')
            ->selectRaw("
                learner_name as name,
                learner_image as image
            ")
            ->join('learners','ko_user_datas.phone','=','learners.learner_phone')
            ->orderBy('song','desc')
            ->limit(10)->get();
        
        // the most discussing user
        $discussUsers=DB::table('ko_user_datas')
            ->selectRaw("
                learner_name as name,
                learner_image as image
            ")
            ->join('learners','ko_user_datas.phone','=','learners.learner_phone')
            ->orderBy('discuss_count','desc')
            ->limit(5)->get();
        
        // try-hard learning users
        $learners=DB::table('ko_user_datas')
            ->selectRaw("
                learner_name as name,
                learner_image as image
            ")
            ->join('learners','ko_user_datas.phone','=','learners.learner_phone')
            ->orderBy('learn_count','desc')
            ->limit(5)->get();
        
        return view ('anouncement.activitykorea',[
            'learners'=>$learners,
            'discussUsers'=>$discussUsers,
            'songs'=>$songs,
            'logins'=>$logins
            ]);
    }
}
