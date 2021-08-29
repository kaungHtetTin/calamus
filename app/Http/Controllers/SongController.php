<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mylike;
use App\Models\Song;
use App\Models\KoreanUserData;

class SongController extends Controller
{
    public function getSong(Request $req){
        $major=$req->major;
        $userId=$req->userId;
        $count=$req->count;
        
         $Songs=DB::table('Songs')
            ->selectRaw("
                   *
                ")
            ->where('Songs.type',$major)
            ->orderBy('Songs.id','desc')
            ->offset($count)
            ->limit(30)
            ->get();
        
            if(!sizeof($Songs)==0){
                
                foreach($Songs as $song){
                    
                    $song->is_liked=0;
                    
                    $likeRows=mylike::where('content_id',$song->song_id)->get();
                    
                    foreach ($likeRows as $row){
                    
                         $likesArr=json_decode($row->likes,true);
                    
                         $user_ids=array_column($likesArr,"user_id");
                         
                        if(in_array( $userId, $user_ids)){
                            $song->is_liked=1;
                            
                        }
                    }
                        $arr[]=$song;
                
                }
                
                return $arr;
                    
            }else{
                    return false;
            }
        
        
        
    }
    
    
     public function getPopularSong(Request $req){
        $major=$req->major;
        $userId=$req->userId;
        
        
        $Songs=DB::table('Songs')
            ->selectRaw("
                   *
                ")
            ->where('Songs.type',$major)
            ->orderBy('Songs.download_count','desc')
            ->limit(50)
            ->get();
        
            if(!sizeof($Songs)==0){
                
                foreach($Songs as $song){
                    
                    $song->is_liked=0;
                    
                    $likeRows=mylike::where('content_id',$song->song_id)->get();
                    
                    foreach ($likeRows as $row){
                    
                         $likesArr=json_decode($row->likes,true);
                    
                         $user_ids=array_column($likesArr,"user_id");
                         
                        if(in_array( $userId, $user_ids)){
                            $song->is_liked=1;
                            
                        }
                    }
                        $arr[]=$song;
                
                }
                
                return $arr;
                    
            }else{
                    return false;
            }
        
        
        
    }
    
    
    
    
     public function searchASong(Request $req){
        $major=$req->major;
        $userId=$req->userId;
        $searching=$req->search;
        
         $Songs=DB::table('Songs')
            ->selectRaw("
                  * 
                ")
           
            ->where('type',$major)
            ->where('title', 'like', '%'.$searching.'%')
            ->Orwhere('artist', 'like', '%'.$searching.'%')
            ->Orwhere('drama', 'like', '%'.$searching.'%')
            ->get();

      
            if(!sizeof($Songs)==0){
                
                foreach($Songs as $song){
                    
                    $song->is_liked=0;
                    
                    $likeRows=mylike::where('content_id',$song->song_id)->get();
                    
                    foreach ($likeRows as $row){
                    
                         $likesArr=json_decode($row->likes,true);
                    
                         $user_ids=array_column($likesArr,"user_id");
                         
                        if(in_array( $userId, $user_ids)){
                            $song->is_liked=1;
                            
                        }
                    }
                    if($song->type==$major){
                         $arr[]=$song;
                    }

                }
                
                return $arr;
                    
            }else{
                    return false;
            }
    }
    
    public function downloadSong(Request $req){
        $songid=$req->song_id;
        Song::where('song_id',$songid)
                    ->update([
                        'download_count'=>DB::raw('download_count+1')
                        
                ]);
    }
    
    public function getArtist(Request $req){
        $major=$req->major;
           $count=$req->count;
           $Songs=DB::table('Songs')
            ->selectRaw("
                    artist,
                    url
                 ")
            ->groupBy('artist')
            ->where('Songs.type',$major)
            ->orderBy('Songs.artist','asc')
            ->offset($count)
            ->limit(50)
            ->get();
            
        
        return $Songs;
        
    }
    
        public function getSongByArtist(Request $req,$artist){
        $count=$req->count;
        $major=$req->major;
        $userId=$req->userId;
           $Songs=DB::table('Songs')
            ->selectRaw("
                      *
                 ")
            ->where('Songs.artist',$artist)
            ->orderBy('Songs.id','desc')
            ->offset($count)
            ->limit(30)
            ->get();
            
            
            if(!sizeof($Songs)==0){
                
                foreach($Songs as $song){
                    
                    $song->is_liked=0;
                    
                    $likeRows=mylike::where('content_id',$song->song_id)->get();
                    
                    foreach ($likeRows as $row){
                    
                         $likesArr=json_decode($row->likes,true);
                    
                         $user_ids=array_column($likesArr,"user_id");
                         
                        if(in_array( $userId, $user_ids)){
                            $song->is_liked=1;
                            
                        }
                    }
                        $arr[]=$song;
                
                }
                
                return $arr;
                    
            }else{
                    return false;
            }
        
    }
    
    
        public function getPopularSongByArtist(Request $req,$artist){
        $major=$req->major;
        $userId=$req->userId;
        
        $Songs=DB::table('Songs')
            ->selectRaw("
                   *
                ")
            ->where('Songs.artist',$artist)
            ->orderBy('Songs.download_count','desc')
            ->limit(20)
            ->get();
        
            if(!sizeof($Songs)==0){
                
                foreach($Songs as $song){
                    
                    $song->is_liked=0;
                    
                    $likeRows=mylike::where('content_id',$song->song_id)->get();
                    
                    foreach ($likeRows as $row){
                    
                         $likesArr=json_decode($row->likes,true);
                    
                         $user_ids=array_column($likesArr,"user_id");
                         
                        if(in_array( $userId, $user_ids)){
                            $song->is_liked=1;
                            
                        }
                    }
                        $arr[]=$song;
                
                }
                
                return $arr;
                    
            }else{
                    return false;
            }
        
        
        
    }
    
    
}
