<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mylike;
use App\Models\Song;
use App\Models\KoreanUserData;

class SongController extends Controller
{
    public function getSong(Request $req,$major){
        
        $userId=$req->userId;
        $page=$req->page;
        $limit=10;
        $count=($page-1)*$limit;
        
        $Songs=DB::table('Songs')
            ->selectRaw("
                   *
                ")
            ->where('Songs.type',$major)
            ->orderBy('Songs.id','desc')
            ->offset($count)
            ->limit($limit)
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
                $response['songs']=$arr;
                return $response;
                    
            }else{
                    return false;
            }
        
    }
    
     public function getPopularSong(Request $req,$major){
        
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
    
    
    
    
    public function searchASong(Request $req,$major){
         
        $searching=$req->search;
        $userId=$req->userId;
        
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
    
    public function getArtist(Request $req,$major){

        $page=$req->page;
        $limit=50;
        $count=($page-1)*$limit;
        $artists=DB::table('Songs')
        ->selectRaw("
                    artist,
                    url
                 ")
        ->groupBy('artist')
        ->where('Songs.type',$major)
        ->orderBy('Songs.artist','asc')
        ->offset($count)
        ->limit($limit)
        ->get();
        
        $response['artists']=$artists;
        return $response;
        
    }
    
    public function getSongByArtist(Request $req,$major){
        
        $artist=$req->artist;
        $userId=$req->userId;
        $page=$req->page;
        $limit=10;
        
        $count=($page-1)*$limit;
      
        $Songs=DB::table('Songs')
            ->selectRaw("
                      *
                 ")
            ->where('Songs.artist',$artist)
            ->orderBy('Songs.id','desc')
            ->offset($count)
            ->limit($limit)
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
            
            $response['songs']=$arr;    
            return $response;
            
                    
        }else{
            return false;
        }
        
    }
    
    
    public function getPopularSongByArtist(Request $req,$major){
        
        $artist=$req->artist;
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
