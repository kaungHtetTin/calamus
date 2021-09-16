<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\learner;
use App\Models\KoreanUserData;
use App\Models\EnglishUserData;
use App\Models\FriendRequest;
use App\Models\Friend;
use Hash;
date_default_timezone_set("Asia/Yangon");
class LearnerController extends Controller
{
    
    public function signUp(Request $req){
        
        $placeholder="https://www.calamuseducation.com/uploads/placeholder.png";
		$name=$req->name;
		$phone=$req->phone;
		$password=$req->password;
		
		$result['result']="";
		
	    $req->validate([
          'name' => 'required|string|max:255',
          'password' => 'required|string|min:4',
          'phone'=>'required|numeric|min:8',
        ]);
        
        
    	if(is_numeric($phone)){
    	   $isExist=learner::where('learner_phone',$phone)->first();
    	   
    	   if($isExist){
    	       $result['result']="This phone has already registered!\nPlease try again using another phone number";
    	   }else{
    	        learner::create([
                  'learner_name' => $req->name,
                  'learner_phone' => $req->phone,
                  'password' => Hash::make($req->password),
                  'learner_image'=>$placeholder,
                  'learner_email'=>"",
                  'gender'=>"",
                  'bd_day'=>"",
                  'bd_month'=>"",
                  'bd_year'=>"",
                  'work'=>"",
                  'education'=>"",
                  'region'=>"",
                  'otp'=>0
                ]);
                
                $result['result']="go";
    	   }
    	}else{
    	    $result['result']="pleae check your phone number!";
    	}
     
       	return json_encode($result);
		
    }
    
    public function logIng(Request $req){
        $phone=$req->phone;
		$password=$req->password;
		
		$result['result']="";
		
		if(is_numeric($phone)){
		    $isExist=learner::where('learner_phone',$phone)->first();
		    
		    if($isExist){
    		    if(Hash::check($password, $isExist->password)){
    		        $result['result']= "go";
    		    }else{
    		        $result['result']= "Wrong password!";
    		    }
    		}else{
    		     $result['result']= "Sorry! This phone has not registered yet.\nCreate new account";
    		}
    		    
		    
		}else{
		    $result['result']="Please check your phone number.";
		}
	
		
		return json_encode($result);
    }
    
    
    public function getProfileData(Request $req){
        $phone=$req->phone;
        return learner::where('learner_phone',$phone)->first();
    }
    
    public function editProfile(Request $req){
        $phone=$req->phone;
        
        if(!empty($req->myfile)){
            //delete old image
            $image =learner::where('learner_phone',$phone)->get();
            $image=$image[0]['learner_image'];
            if($image!=""){
                $image = basename($image);
                $file=$_SERVER['DOCUMENT_ROOT'].'/uploads/profiles/'.$image;
                if(file_exists($file)){
                    unlink($file);
                }
            }
           
            //insert new image
            $file=$req->file('myfile');
            $result=Storage::disk('calamusPost')->put('profiles',$file);
            $myPath="https://www.calamuseducation.com/uploads/";
            $imagePath=$myPath.$result;
            learner::where('learner_phone',$phone)->update(['learner_image'=>$imagePath]);
        
        }
        
        if(!empty($req->name)&&isset($req->name)){
            $name=$req->name;
            learner::where('learner_phone',$phone)->update(['learner_name'=>$name]);
        }
        
        if(!empty($req->email)&&isset($req->email)){
            $email=$req->email;
            learner::where('learner_phone',$phone)->update(['learner_email'=>$email]);
        }else{
            learner::where('learner_phone',$phone)->update(['learner_email'=>""]);
        }
        
        if(!empty($req->gender)&&isset($req->gender)){
            $gender=$req->gender;
            learner::where('learner_phone',$phone)->update(['gender'=>$gender]);
        }else{
            learner::where('learner_phone',$phone)->update(['gender'=>""]);
        }
        
        if(!empty($req->education)&&isset($req->education)){
            $education=$req->education;
            learner::where('learner_phone',$phone)->update(['education'=>$education]);
        }else{
            learner::where('learner_phone',$phone)->update(['education'=>""]);
        }
        
        if(!empty($req->work)&&isset($req->work)){
            $work=$req->work;
            learner::where('learner_phone',$phone)->update(['work'=>$work]);
        }else{
            learner::where('learner_phone',$phone)->update(['work'=>""]);
        }
        
        if(!empty($req->region)&&isset($req->region)){
            $region=$req->region;
            learner::where('learner_phone',$phone)->update(['region'=>$region]);
        }else{
            learner::where('learner_phone',$phone)->update(['region'=>""]);
        }
        
        if(!empty($req->bd_day)&&!empty($req->bd_month)&&!empty($req->bd_year)){
            $bd_day=$req->bd_day;
            $bd_month=$req->bd_month;
            $bd_year=$req->bd_year;
            learner::where('learner_phone',$phone)->update(['bd_day'=>$bd_day]);
            learner::where('learner_phone',$phone)->update(['bd_month'=>$bd_month]);
            learner::where('learner_phone',$phone)->update(['bd_year'=>$bd_year]);
        }else{
            learner::where('learner_phone',$phone)->update(['bd_day'=>""]);
            learner::where('learner_phone',$phone)->update(['bd_month'=>""]);
            learner::where('learner_phone',$phone)->update(['bd_year'=>""]);
        }
        
        return learner::where('learner_phone',$phone)->first();
    }
    
    public function easyEnglishLogin(Request $req){
        
        $phone=$req->phone;
		$token=$req->token;
		
	    DB::table('ee_user_datas')
	    ->updateOrInsert(
	        ['phone'=>$phone],
	        [
	            'token'=>$token,
	            'login_time'=>DB::raw('login_time+1'),
	            'last_active'=>now(),
	       ]
	   );
	   
	   $tempdata=EnglishUserData::where('phone',$phone)->first();
	   $login_time=$tempdata->login_time;
	   if($login_time<2){
	       EnglishUserData::where('phone',$phone)->update(['first_join'=>now()]);
	   }
	  
	   $userData=DB::table('learners')
        ->selectRaw('
                learners.learner_name as name,
		        learners.learner_email as email,
		        learners.learner_image as imageUrl,
		        ee_user_datas.game_score as gameScore,
		        ee_user_datas.is_vip as isVip
            ')
        ->where('learners.learner_phone',$phone)
        ->join('ee_user_datas','ee_user_datas.phone','=','learners.learner_phone')
        ->first();
        
        $vipCourses=DB::table('VipUsers')
        ->selectRaw('
            VipUsers.course
            ')
        ->where('VipUsers.phone',$phone)
        ->where('VipUsers.major','english')
        ->get();
        
        $data['user']=$userData;
		$data['version']="2.12"; //easy english
        $data['vipCourses']=$vipCourses;
        return $data;
        
    }
    
    public function koreanLogin(Request $req){
        $phone=$req->phone;
		$token=$req->token;
	//	
		$today=date("Y/m/d h:i:sa");
		
	//	$token="abcdef";
	    DB::table('ko_user_datas')
	    ->updateOrInsert(
	        ['phone'=>$phone],
	        [
	            'token'=>$token,
	            'login_time'=>DB::raw('login_time+1'),
	            'last_active'=>now(),
	       ]
	   );
	   
	   $tempdata=KoreanUserData::where('phone',$phone)->first();
	   $login_time=$tempdata->login_time;
	   if($login_time<2){
	       KoreanUserData::where('phone',$phone)->update(['first_join'=>now()]);
	   }
	  
	   
	   $userData=DB::table('learners')
        ->selectRaw('
                learners.learner_name as name,
		        learners.learner_email as email,
		        learners.learner_image as imageUrl,
		        ko_user_datas.game_score as gameScore,
		        ko_user_datas.is_vip as isVip
            ')
        ->where('learners.learner_phone',$phone)
        ->join('ko_user_datas','ko_user_datas.phone','=','learners.learner_phone')
        ->first();
        
        $vipCourses=DB::table('VipUsers')
            ->selectRaw('
                VipUsers.course
                ')
            ->where('VipUsers.phone',$phone)
            ->where('VipUsers.major','korea')
            ->get();
        
        $data['user']=$userData;
        $data['vipCourses']=$vipCourses;
		$data['version']="2.19"; //easy korean
        
        return $data;
	   
    }
    
    public function getKoreanTopGamer(){
         $koreanTopGamers=DB::table('learners')
        ->selectRaw('
                learners.learner_name,
                learners.learner_image,
        	    ko_user_datas.game_score
            ')
        ->join('ko_user_datas','ko_user_datas.phone','=','learners.learner_phone')
        ->orderBy('ko_user_datas.game_score','desc')
        ->limit(5)
        ->get();
        
        return $koreanTopGamers;
    }
    
    public function getEnglishTopGamer(){
         $englishTopGamers=DB::table('learners')
        ->selectRaw('
                learners.learner_name,
                learners.learner_image,
        	    ee_user_datas.game_score
            ')
        ->join('ee_user_datas','ee_user_datas.phone','=','learners.learner_phone')
        ->orderBy('ee_user_datas.game_score','desc')
        ->limit(5)
        ->get();
        
        return $englishTopGamers;
    }
    
      public function getUserProfile($myId,$otherId,$major){
          
        $count=$major."_count";  
          
        $data['profile']=learner::where('learner_phone',$otherId)->first();
        $data['friendship']="none";
      
        if($major=="korea"){
            $token=KoreanUserData::where('phone',$otherId)->first();
        }else{
            $token=EnglishUserData::where('phone',$otherId)->first();
        }
        
        $data['token']=$token->token;
        $reqRow=FriendRequest::where("user_id",$otherId)->first();
        if($reqRow){
            
            $number=$reqRow->$count;
            if($number>399){
                 $data['friendship']="reqLimit";
            }
            
            $friRequestArr=json_decode($reqRow->$major,true);
            if($friRequestArr!=null){
                $my_ids=array_column($friRequestArr,"my_id");
                if(in_array( $myId, $my_ids)){
                      $data['friendship']="request";
                }
            }
        }
        

        
        $reqRow=FriendRequest::where("user_id",$myId)->first();
        if($reqRow){
            $friRequestArr=json_decode($reqRow->$major,true);
            if($friRequestArr!=null){
                $my_ids=array_column($friRequestArr,"my_id");
                if(in_array( $otherId, $my_ids)){
                     $data['friendship']="confirm";
                }
            }
        }
        
        
        $reqRow=Friend::where("user_id",$myId)->first();
        if($reqRow){
            $friArr=json_decode($reqRow->$major,true);
            if($friArr!=null){
                $fri_ids=array_column($friArr,"fri_id");
                if(in_array( $otherId, $fri_ids)){
                     $data['friendship']="friend";
                }
            }
        }
        
        $friRow=Friend::where("user_id",$otherId)->first();
        if($friRow){
            $number=$friRow->$count;
            if($number>299){
                 $data['friendship']="friLimit";
            }
        }
        
        if($myId==$otherId){
            $data['friendship']="me";
        }
        
        return $data;
    }
    
    public function searchSomeone($major,$search){
        
        if($major=="korea"){
            $joinTable="ko_user_datas";
        }else{
            $joinTable="ee_user_datas";
        }
        
      //  $users=learner::where('learner_name','like',"%$search%")->Orwhere('learner_phone',$search)->get();
        
        $users=DB::table($joinTable)
        ->selectRaw("
                learners.learner_name as userName,
        	    learners.learner_phone as userId,
        	    learners.learner_image as userImage
        ")
        ->where('learners.learner_name','like',"%$search%")
        ->Orwhere('learners.learner_phone',$search)
        ->join('learners','learners.learner_phone','=',"$joinTable.phone")
        ->get();
        
        $posts=DB::table('posts')
        ->selectRaw("
                learners.learner_name as userName,
        	    learners.learner_phone as userId,
        	    learners.learner_image as userImage,
        	    posts.post_id as postId,
        	    posts.body as body,
        	    posts.image as postImage,
        	    posts.has_video
            ")
        ->where('posts.major',$major)
        ->where('posts.body','like',"%$search%")
        ->join('learners','learners.learner_phone','=','posts.learner_id')
        ->get();
        
        $responseData['user']=$users;
        $responseData['post']=$posts;
        return $responseData;
        
    }

}
