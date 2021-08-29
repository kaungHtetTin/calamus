<?php

namespace App\Http\Controllers;
use App\Models\artist;
use App\Models\requestedsong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Song;

class RequestedSongController extends Controller
{
    public function getRequestSong($id){
        $artist=artist::where('id',$id)->first();
        $songs=requestedsong::where('artist_id',$id)
        ->orderBy('vote','desc')
        ->get();
        $userid=session('currentUser');

        if(!sizeof($songs)==0){
                
            foreach($songs as $song){
                
                $song->voted=0;

                $voteArrs=json_decode($song->is_voted,true);
                $user_ids=array_column($voteArrs,"user_id");
                if(in_array( $userid, $user_ids)){
                    $song->voted=1;
                    
                }
                $song->is_voted="";
                $arr[]=$song;
            }
            
             return view('anouncement.songList',[
            'artist'=>$artist,
            'songs'=>$arr,
            'userid'=>session('currentUser')
            ]);
                
        }


        return view('anouncement.songList',[
            'artist'=>$artist,
            'songs'=>$songs,
            'userid'=>session('currentUser')
        ]);
    }

    public function requestSong(Request $req,$id){
        
        $songName=$req->requestedSongName;
        $isSongExistOnSongs=song::where('title',$songName)->first();

        if($isSongExistOnSongs){
            return view('anouncement.errorsong',[
                'error'=>1,
                'song'=>$songName
            ]);
        }

        $isSongExistOnRequested=requestedsong::where('name',$songName)->first();
        if($isSongExistOnRequested){
            return view('anouncement.errorsong',[
                'error'=>2,
                'song'=>$songName
            ]);
        }
        
        $song=new requestedsong;
        $song->artist_id=$id;
        $song->name=$req->requestedSongName;
        $song->vote=0;
        $song->is_voted="[]";
        $song->save();
        return back()->withInput();
            //return redirect('/artists/request/'.$id);
        
    }

    public function voteASong(Request $req,$userid){
        $songid=$req->songid;
        $song=requestedsong::where('id',$songid)->first();
        $voteArrs=json_decode($song->is_voted,true);
        $user_ids=array_column($voteArrs,"user_id");

        if(in_array( $userid, $user_ids)){
            //make unvote
            $key=array_search($userid, $user_ids);
            array_splice($voteArrs, $key, 1);

            $voteJsongString=json_encode($voteArrs);
            requestedsong::where('id',$songid)
            ->update([
                'is_voted'=>$voteJsongString,
                'vote'=>DB::raw('vote-1')
            
            ]);

            
        }else{
            //make vote
            $arr['user_id']=$userid;
            $voteArrs[]=$arr;
            $voteJsongString=json_encode($voteArrs);
            requestedsong::where('id',$songid)
            ->update([
                'is_voted'=>$voteJsongString,
                'vote'=>DB::raw('vote+1')
            
            ]);
        }

        return back()->withInput();

    }
    
    
     public function getMostVotedSong($nation){


       $songs=DB::table('requestedsongs')
        ->selectRaw(
           "
           requestedsongs.id as id,
           requestedsongs.name as name,
           requestedsongs.is_voted as is_voted,
           requestedsongs.vote as vote,
           requestedsongs.artist_id as artist_id,
           artists.name as artist
           "
        )
        ->where('artists.nation',$nation)
        ->orderBy('vote','desc')
        ->join('artists','artists.id','=','requestedsongs.artist_id')
        ->limit(50)
        ->get();
        $userid=session('currentUser');

        if(!sizeof($songs)==0){
                
            foreach($songs as $song){
                
                $song->voted=0;

                $voteArrs=json_decode($song->is_voted,true);
                $user_ids=array_column($voteArrs,"user_id");
                if(in_array( $userid, $user_ids)){
                    $song->voted=1;
                    
                }
                $song->is_voted="";
                $arr[]=$song;
              
            }
            
             return view('anouncement.votedsong',[
            'songs'=>$arr,
            'userid'=>session('currentUser')
            ]);
                
        }
        return view('anouncement.votedsong',[
            'songs'=>$songs,
            'userid'=>session('currentUser')
        ]);
    }


}
