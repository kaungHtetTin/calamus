<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\learner;
use App\Models\KoreanUserData;
use App\Models\EnglishUserData;
use App\Models\ChineseUserData;
use App\Models\JapaneseUserData;
use App\Models\RussianUserData;  

class LiveClassController extends Controller
{
    public function brainTrainingClass(Request $req){

        if(isset($req->userid)){
            return view('live-classes.brain',[
                'userid'=>$req->userid
            ]);
        }

        return view('live-classes.brain');
    }

    public function registerBrainTrainingClass(Request $req){

        $req->validate([
            'phone'=>'required'
        ]);

        $phone=$req->phone;
        if(!is_numeric($phone)){
            return back()->with('err','Please check your phone number!');
        }

        $user=learner::where('learner_phone',$phone)->first();

        if(!$user){
            return back()->with('err','ဤဖုန်းနံပါတ်သည် Calamus Education တွင် Account မှတ်ပုံတင်ထားခြင်းမရှိပါ');
        }

        $english=EnglishUserData::where('phone',$phone)->first();
        $korea=KoreanUserData::where('phone',$phone)->first();

        if(
            $english->gold_plan==0 &&
            $korea->gold_plan==0
        ){
            return back()->with('err',"ဝမ်းနည်းပါတယ် $user->learner_name .. သင်သည် Calamus Education ၏ Gold Plan Member တစ်ဦးမဟုတ်ပါ ");
        }


        
        return back()->with('link','This is link');
    }
}
