<?php

namespace App\Http\Controllers;
use App\Models\artist;
use Illuminate\Http\Request;


class ArtistController extends Controller
{

    public function handleArtistList(){
        $jon= file_get_contents(base_path('resources/lang/artist.json'));
        $arr=json_decode($jon,true);
        $arts=$arr['Sheet1'];
        
        $a="";
        foreach($arts as $art){
            $artist=new artist;
            $artist->name=$art['artist'];
            $artist->nation="korea";
            $artist->url="https://";
            $artist->save();
            $a=$a.$art['artist']."<br>";
        }

        return $a;
    }

    public function getArtist(Request $req,$nation){
        $userid= $req->userid;
        $artists=artist::where('nation',$nation)->orderBy('name')->get();
        $req->session()->put('currentUser',$userid);
        return view('anouncement.songrequest',[
            'artists'=>$artists,
            'lang'=>$nation
        ]);
    }

    

}
