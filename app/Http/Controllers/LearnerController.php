<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\learner;
use App\Models\KoreanUserData;
use App\Models\EnglishUserData;
use App\Models\ChineseUserData;
use App\Models\JapaneseUserData;
use App\Models\RussianUserData;  
use App\Models\FriendRequest;
use App\Models\Friend;
use App\Models\Block;
use Hash;
date_default_timezone_set("Asia/Yangon");
class LearnerController extends Controller
{
    
    
    
    public function checkAccount(Request $req){
        
        $phone=$req->phone;
        
        $result=learner::where('learner_phone',$phone)->first();
        if($result){
            $response['exist']=true;
        }else{
            $response['exist']=false;
        }
        
        return $response;
    }
    
    
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
    	        $name=$req->name." ";
    	        learner::create([
                  'learner_name' => $name,
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
                  'bio'=>"",
                  'cover_image'=>"",
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
    
    public function loadUserData(Request $req,$major){
        
        $phone=$req->phone;
		$token=$req->token;
		
		if($major=="english"){
		    $dataTable="ee_user_datas";
		    $loginTime=EnglishUserData::where('phone',$phone)->first();
		    $data['version']="3.1.6"; 
		    $data['music']="on";
		    $data['inappads']="on";
		}else if($major=="korea"){
		    $dataTable="ko_user_datas";
		    $loginTime=KoreanUserData::where('phone',$phone)->first();
		    $data['version']="3.2.4";
		    $data['music']="on";
		    $data['inappads']="on";
		}else if($major=="chinese"){
		    $dataTable="cn_user_datas";
		    $loginTime=ChineseUserData::where('phone',$phone)->first();
		    $data['version']="1.0.0";
		    $data['music']="on";
		    $data['inappads']="on";
		}else if($major=="japanese"){
		    $dataTable="jp_user_datas";
		    $loginTime=JapaneseUserData::where('phone',$phone)->first();
		    $data['version']="1.0.0";
		    $data['music']="on";
		    $data['inappads']="on";
		}else if($major=="russian"){
            $dataTable="ru_user_datas";
		    $loginTime=RussianUserData::where('phone',$phone)->first();
		    $data['version']="1.0.0";
		    $data['music']="on";
		    $data['inappads']="on";
        }
		
		if(!$loginTime){
	       DB::table("$dataTable")
    	    ->updateOrInsert(
    	        ['phone'=>$phone],
    	        [
    	            'token'=>$token,
    	            'login_time'=>DB::raw('login_time+1'),
    	            'last_active'=>now(),
    	            'first_join'=>now()
    	       ]
    	   );
	   }else{
	        DB::table("$dataTable")
    	    ->updateOrInsert(
    	        ['phone'=>$phone],
    	        [
    	            'token'=>$token,
    	            'login_time'=>DB::raw('login_time+1'),
    	            'last_active'=>now(),
    	       ]
    	   );
	   }
		

	   $userData=DB::table('learners')
        ->selectRaw("
                learners.learner_name as name,
		        learners.learner_email as email,
		        learners.learner_image as imageUrl,
		        $dataTable.game_score as gameScore,
		        $dataTable.is_vip as isVip
            ")
        ->where('learners.learner_phone',$phone)
        ->join("$dataTable","$dataTable.phone",'=',"learners.learner_phone")
        ->first();
        
        $userData->name=$userData->name." ";
        
        $vipCourses=DB::table('VipUsers')
        ->selectRaw('
            VipUsers.course_id
            ')
        ->where('VipUsers.phone',$phone)
        ->where('VipUsers.major',$major)
        ->get();
        
        $enrolls=DB::table('courses')
            ->selectRaw("
                courses.course_id,
                count(*) as learned,
                courses.lessons_count as total
            ")
            ->groupBy("courses.course_id")
            ->where("studies.learner_id",$phone)
            ->where("courses.major",$major)
            ->join("lessons_categories","lessons_categories.course_id","=","courses.course_id")
            ->join("lessons","lessons_categories.id","=","lessons.category_id")
            ->join("studies","lessons.id","=","studies.lesson_id")
            ->get();
        
        $data['user']=$userData;
        $data['vipCourses']=$vipCourses;
        $data['enrollProgress']=$enrolls;
        return $data;
        
    }
    
    
    public function getProfileData($major,$phone){
         
        return learner::where('learner_phone',$phone)->first();
    }
    
    public function changeBio(Request $req){
        $phone=$req->userId;
        $bio=$req->bio;
        
        learner::where('learner_phone',$phone)->update(['bio'=>$bio]);
        
        return "Saved";
    }
    
    public function changeCoverPhoto(Request $req){
        $phone=$req->phone;
        if(!empty($req->cover_photo)){
            //delete old image
            $cover_image =learner::where('learner_phone',$phone)->get();
            $cover_image=$cover_image[0]['cover_image'];
            
            if($cover_image!=""){
                $cover_image = basename($cover_image);
                $file=$_SERVER['DOCUMENT_ROOT'].'/uploads/covers/'.$cover_image;
                if(file_exists($file)){
                    unlink($file);
                }
            }
           
            //insert new image
            $file=$req->file('cover_photo');
            $result=Storage::disk('calamusPost')->put('covers',$file);
            $myPath="https://www.calamuseducation.com/uploads/";
            $imagePath=$myPath.$result;
            learner::where('learner_phone',$phone)->update(['cover_image'=>$imagePath]);
        }
        
        return "changed";
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
        
        if(!empty($req->cover_photo)){
            //delete old image
            $cover_image =learner::where('learner_phone',$phone)->get();
            $cover_image=$cover_image[0]['cover_image'];
            
            if($cover_image!=""){
                $cover_image = basename($cover_image);
                $file=$_SERVER['DOCUMENT_ROOT'].'/uploads/covers/'.$cover_image;
                if(file_exists($file)){
                    unlink($file);
                }
            }
           
            //insert new image
            $file=$req->file('cover_photo');
            $result=Storage::disk('calamusPost')->put('covers',$file);
            $myPath="https://www.calamuseducation.com/uploads/";
            $imagePath=$myPath.$result;
            learner::where('learner_phone',$phone)->update(['cover_image'=>$imagePath]);
        }
        
        if(!empty($req->name)&&isset($req->name)){
            $name=$req->name." ";
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
    
    
    public function getTopGamer(Request $req,$major){
        
        $mCode=$req->mCode;
        
        $dataStore=$mCode."_user_datas";
         $TopGamers=DB::table('learners')
        ->selectRaw("
                learners.learner_name,
                learners.learner_image,
                learners.learner_phone as user_id,
        	    $dataStore.game_score
            ")
        ->join($dataStore,"$dataStore.phone",'=','learners.learner_phone')
        ->orderBy("$dataStore.game_score",'desc')
        ->limit(5)
        ->get();
        
        return $TopGamers;
    }
    
    public function getUserProfile($major,$myId,$otherId){
          
        $count=$major."_count";  
          
        $data['profile']=learner::where('learner_phone',$otherId)->first();
        $data['friendship']="none";
      
        if($major=="korea"){
            $token=KoreanUserData::where('phone',$otherId)->first();
        }else if($major=="english"){
            $token=EnglishUserData::where('phone',$otherId)->first();
        }else if($major=="chinese"){
            $token=ChineseUserData::where('phone',$otherId)->first();
        }else if($major=="japanese"){
             $token=JapaneseUserData::where('phone',$otherId)->first();
        }else if($major=="russian"){
            $token=RussianUserData::where('phone',$otherId)->first();
        }
        
        $data['token']=$token->token;
        $data['is_vip']=$token->is_vip;
        
        $enrolls=DB::table('courses')
            ->selectRaw("
                courses.course_id,
                courses.title,
                count(*) as learned,
                courses.lessons_count as total
            ")
            ->groupBy("courses.course_id")
            ->where("studies.learner_id",$otherId)
            ->where("courses.major",$major)
            ->join("lessons_categories","lessons_categories.course_id","=","courses.course_id")
            ->join("lessons","lessons_categories.id","=","lessons.category_id")
            ->join("studies","lessons.id","=","studies.lesson_id")
            ->get();
        
        $data['enroll']=$enrolls;
        
        if($myId==$otherId){
            $data['friendship']="me";
                 
            return $data;
        }
        
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
        $block=Block::where('user_id',$myId)->where('blocked_user_id',$otherId)->first();
        if($block){
            $data['block']=true;
        }else{
            $data['block']=false;
        }
        
        return $data;
    }
    
    public function searchSomeone(Request $req,$major){
        
        $search=$req->search;
        $mCode=$req->mCode;
        $joinTable=$mCode."_user_datas";
       
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

    public function blockUser(Request $req){
        $user_id=$req->user_id;
        $blocked_user_id=$req->blocked_user_id;
        $block=new Block();
        $block->user_id=$user_id;
        $block->blocked_user_id=$blocked_user_id;
        $block->save();

        return "User was blocked!";
    }

    public function unblockUser(Request $req)
    {
        $user_id=$req->user_id;
        $blocked_user_id=$req->blocked_user_id;
        Block::where('user_id',$user_id)->where('blocked_user_id',$blocked_user_id)->delete();

        return "User unblocked";

    }
    public function getBlockUsers(Request $req){
        $user_id=$req->user_id;
        $blockedUsers=Block::join('learners','learners.learner_phone','=','blocks.blocked_user_id')->where('blocks.user_id',$user_id)->get();
        return $blockedUsers;
    }

}
