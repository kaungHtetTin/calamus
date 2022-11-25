<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\Friend;
use App\Models\learner;
use App\Models\KoreanUserData;
use App\Models\EnglishUserData;
use App\Models\ChineseUserData;
use App\Models\JapaneseUserData;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    //
    
    public function addFriend(Request $req,$major){
        $myId=$req->my_id;
        $otherId=$req->other_id;
        $count=$major."_count";
        $myFriCount=Friend::where('user_id',$myId)->pluck($count)->first();
        
        //get data for push notification;
        $myName=learner::where('learner_phone',$myId)->pluck('learner_name')->first();
        if($major=="korea")$friToken=KoreanUserData::where('phone',$otherId)->pluck('token')->first();
        if($major=="english")$friToken=EnglishUserData::where('phone',$otherId)->pluck('token')->first();
        if($major=="chinese")$friToken=ChineseUserData::where('phone',$otherId)->pluck('token')->first();
        if($major=="japanese")$friToken=JapaneseUserData::where('phone',$otherId)->pluck('token')->first();
        
        $reqRow=FriendRequest::where("user_id",$otherId)->first();
        if($reqRow){
        
            $friRequestArr=json_decode($reqRow->$major,true);
            if($friRequestArr!=null){
            
                $my_ids=array_column($friRequestArr,"my_id");
                  
                if(in_array( $myId, $my_ids)){
                    $key=array_search($myId, $my_ids);
                    array_splice($friRequestArr, $key, 1);
                    $req_string=json_encode($friRequestArr);
                    FriendRequest::where("user_id",$otherId)->update([
                            $major=>$req_string,
                            $count=>DB::raw("$count-1")
                        ]);
                    return "unsent request";
                    
                }else{
                    
                    if($myFriCount>299){
                        $res['code']="err53";  //you are in max fri limit
                        return json_encode($res);
                    }
                    
                    $arr['my_id']=$myId;
                    $friRequestArr[]=$arr;
                    $req_string=json_encode($friRequestArr);
                    FriendRequest::where("user_id",$otherId)->update([
                            $major=>$req_string,
                            $count=>DB::raw("$count+1")
                        ]);
                    FirebaseNotiPushController::pushNotificationToSingleUserByServer($friToken,"Request",$myName." sent a friend request.","3");
                    return "requested";
                }
            }else{
                
                    if($myFriCount>299){
                        $res['code']="err53";  //you are in max fri limit
                        return json_encode($res);
                    }
                
                    $arr['my_id']=$myId;
                    $arr2[]=$arr;
        			$firReqString=json_encode($arr2);
        			FriendRequest::where("user_id",$otherId)->update([
        			        $major=>$firReqString,
        			        $count=>DB::raw("$count+1")
        			    ]);
        			FirebaseNotiPushController::pushNotificationToSingleUserByServer($friToken,"Request",$myName." sent a friend request.","3");
        			return "first request";
            }

             
        }else{
            
            if($myFriCount>299){
                $res['code']="err53";  //you are in max fri limit
                return json_encode($res);
            }
            
            $arr['my_id']=$myId;
            $arr2[]=$arr;
			$firReqString=json_encode($arr2);
	
			$FriendRequest=new FriendRequest;
			
			$FriendRequest->user_id=$otherId;
			$FriendRequest->$major=$firReqString;
	        $FriendRequest->$count=1;
			$FriendRequest->save();
			FirebaseNotiPushController::pushNotificationToSingleUserByServer($friToken,"Request",$myName." sent a friend request.","3");
			return "first request";
        }
    }
    
    
    public function RemoveFriendRequest(Request $req,$major){
        $myId=$req->my_id;
        $otherId=$req->other_id;
        $count=$major."_count";
   
        $reqRow=FriendRequest::where("user_id",$myId)->first();
        
        
        if($reqRow){
            $friRequestArr=json_decode($reqRow->$major,true);
            if($friRequestArr!=null){
                $my_ids=array_column($friRequestArr,"my_id");
                if(in_array($otherId, $my_ids)){
                    $key=array_search($otherId, $my_ids);
                    array_splice($friRequestArr, $key, 1);
                    $req_string=json_encode($friRequestArr);
                    FriendRequest::where("user_id",$myId)->update([
                        $major=>$req_string,
                        $count=>DB::raw("$count-1")
                    ]);
                    
                    return "remove request";
                }
            }
        }
    }
    
    public function confrimFriend(Request $req,$major){
        $myId=$req->my_id;
        $otherId=$req->other_id;
        $count=$major."_count";
        
        //get data for push notification;
        $myName=learner::where('learner_phone',$myId)->pluck('learner_name')->first();
        if($major=="korea")$friToken=KoreanUserData::where('phone',$otherId)->pluck('token')->first();
        if($major=="english")$friToken=EnglishUserData::where('phone',$otherId)->pluck('token')->first();
        if($major=="chinese")$friToken=ChineseUserData::where('phone',$otherId)->pluck('token')->first();
        if($major=="japanese")$friToken=JapaneseUserData::where('phone',$otherId)->pluck('token')->first();
       
        
        $myFriCount=Friend::where('user_id',$myId)->pluck($count)->first();
        if($myFriCount>299){
            $res['code']="err53";  //you are in max fri limit
            return json_encode($res);
        }
        $otherFriCount=Friend::where('user_id',$otherId)->pluck($count)->first();
        if($otherFriCount>299){
            $res['code']="err54";  //your friend is in max fri limit
            return json_encode($res);
        }
        
        //Delete user in my request list
        $reqRow=FriendRequest::where("user_id",$myId)->first();
        if($reqRow){
            $friRequestArr=json_decode($reqRow->$major,true);
            if($friRequestArr!=null){
                $my_ids=array_column($friRequestArr,"my_id");
                if(in_array($otherId, $my_ids)){
                    $key=array_search($otherId, $my_ids);
                    array_splice($friRequestArr, $key, 1);
                    $req_string=json_encode($friRequestArr);
                    FriendRequest::where("user_id",$myId)->update([
                        $major=>$req_string,
                        $count=>DB::raw("$count-1")
                    ]);
                }
            }
        }
       
        
        //Add user to my friend list
        $friRow=Friend::where("user_id",$myId)->first();
        if($friRow){
            $friArr=json_decode($friRow->$major,true);
            $arr['fri_id']=$otherId;
            $friArr[]=$arr;
            $fri_string=json_encode($friArr);
            Friend::where("user_id",$myId)->update([
                $major=>$fri_string,
                $count=>DB::raw("$count+1")
            ]);
           
        }else{
            
            $arr['fri_id']= $otherId;
            $arr2[]=$arr;
			$friString=json_encode($arr2);
	
			$Friend=new Friend;
			
			$Friend->user_id=$myId;
			$Friend->$major=$friString;
			$Friend->$count=1;
			$Friend->save();
			 
        }
        
        
        //add me to user's friend's list
        
        $friRow=Friend::where("user_id",$otherId)->first();
        if($friRow){
            $friArr=json_decode($friRow->$major,true);
            $arr['fri_id']=$myId;
            $friArr[]=$arr;
            $fri_string=json_encode($friArr);
            Friend::where("user_id",$otherId)->update([
                $major=>$fri_string,
                $count=>DB::raw("$count+1")
            ]);
           
        }else{
            
            $arr['fri_id']= $myId;
            $arr3[]=$arr;
			$friString=json_encode($arr3);
	
			$Friend=new Friend;
			
			$Friend->user_id=$otherId;
			$Friend->$major=$friString;
			$Friend->$count=1;
			$Friend->save();
			 
        }
        
        FirebaseNotiPushController::pushNotificationToSingleUserByServer($friToken,"Accept",$myName." accept your friend request.","4");
        
    }
    
    public function unfriend(Request $req,$major){
        $myId=$req->my_id;
        $otherId=$req->other_id;
        $count=$major."_count";
        
        $friRow=Friend::where("user_id",$myId)->first();
        if($friRow){
            $friArr=json_decode($friRow->$major,true);
            $fri_ids=array_column($friArr,"fri_id");
            
            if(in_array($otherId, $fri_ids)){
                $key=array_search($otherId, $fri_ids);
                array_splice($friArr, $key, 1);
                $fri_string=json_encode($friArr);
                Friend::where("user_id",$myId)->update([
                    $major=>$fri_string,
                    $count=>DB::raw("$count-1")
                ]);
                
            }
        }
        
        $friRow2=Friend::where("user_id",$otherId)->first();
        if($friRow2){
            $friArr=json_decode($friRow2->$major,true);
            $fri_ids=array_column($friArr,"fri_id");
            
            if(in_array($myId, $fri_ids)){
                $key=array_search($myId, $fri_ids);
                array_splice($friArr, $key, 1);
                $fri_string=json_encode($friArr);
                Friend::where("user_id",$otherId)->update([
                    $major=>$fri_string,
                    $count=>DB::raw("$count-1")    
                ]);
                
            }
        }
    }
    
    public function getFriends(Request $req,$major){
        
        $dataStore=$req->mCode;
        $id=$req->userId;
        
        $joinTable=$dataStore."_user_datas";  
        $friendRow=Friend::where('user_id',$id)->first();
        $friend=$friendRow->$major;
        
        $friArr=json_decode($friend,true);
        if($friArr!=null){
            $user_ids=array_column($friArr,"fri_id");
            foreach( array_reverse($user_ids) as $user_id){
                $user=DB::table('learners')
                                ->selectRaw("
                        learners.learner_name as userName,
                        learners.learner_image as userImage,
                        learners.learner_phone as phone,
                        friends.$major as friends,
                        $joinTable.token
                ")
                ->where('learners.learner_phone',$user_id)
                ->join($joinTable,$joinTable.'.phone','=','learners.learner_phone')
                ->join('friends','friends.user_id','=','learners.learner_phone')
                ->first();
                    
                if($user!=null)$arr[]=$user;
        
            }
        }
        
        return $arr;
    }
    
    public function getFriendRequests(Request $req, $major){
        
        $dataStore=$req->mCode;
        $id=$req->userId;
        
        $joinTable=$dataStore."_user_datas";
        
        $friendReqRow=FriendRequest::where('user_id',$id)->first();
        
        if($friendReqRow)$friendReq=$friendReqRow->$major;
        else $friendReq=null;
        $friReqArr=json_decode($friendReq,true);
     
        if($friReqArr!=null){
            $user_ids=array_column($friReqArr,"my_id");
            foreach( array_reverse($user_ids) as $user_id){
                $user=DB::table('learners')
                                ->selectRaw("
                        learners.learner_name as userName,
                        learners.learner_image as userImage,
                        learners.learner_phone as phone,
                        $joinTable.token
                ")
                ->where('learners.learner_phone',$user_id)
                ->join($joinTable,$joinTable.'.phone','=','learners.learner_phone')
                
                ->first();
                
                $friendRow=Friend::where('user_id',$user_id)->first();
                if($friendRow!=null){
                    $friend=$friendRow->$major;
                    $user->friends=$friend;
                }else{
                    $user->friends=null;
                }
                if($user!=null)$arr[]=$user;
        
            }
        }else{
            $arr=null;
        }
    
        //get people you may know
        
        $users=DB::table('learners')
            ->selectRaw("
                learners.learner_name as userName,
                learners.learner_image as userImage,
                learners.learner_phone as phone,
                $joinTable.token
            ")
            ->join($joinTable,"$joinTable.phone",'=','learners.learner_phone')
            ->orderBy("$joinTable.id",'desc')
            ->limit(40)
            ->get();
        
        
        //filtering people in my friend list
        
        $friendRow=Friend::where('user_id',$id)->first();
        if($friendRow)$friends=$friendRow->$major;
        else $friends=null;
        
        $friArr=json_decode($friends,true);
        if($friArr!=null){    
            $fri_ids=array_column($friArr,"fri_id");
            foreach($users as $user){
                if(!in_array( $user->phone, $fri_ids)){
                    $friendFilteredUsers[]=$user;
                }
            }
        
        }else{
            $friendFilteredUsers=$users;
        }
        
        //filtering people in my friend request
        if($friReqArr!=null){
            $req_ids=array_column($friReqArr,"my_id");
            foreach($friendFilteredUsers as $user){
            if(!in_array( $user->phone, $req_ids)){
                    $requestFilteredUsers[]=$user;
                }      
            }
         }else{
             $requestFilteredUsers=$friendFilteredUsers;
        }
        
        //filtering people in their friend request
        foreach($requestFilteredUsers as $user){
            $friReqRow=FriendRequest::where('user_id',$user->phone)->first();
            
            $friendRow=Friend::where('user_id',$user->phone)->first();
            if($friendRow){
                $friend=$friendRow->$major;
                $user->friends=$friend;
            }else{
                $user->friends=null;
            }
          
        
            
            if($friReqRow){
                $friReqArr=json_decode($friReqRow->$major,true);
                if($friReqArr==null){
                    $finalFilteredUsers[]=$user;
                }else{
                    $user_ids=array_column($friReqArr,"my_id");
                    if(!in_array( $id, $user_ids)){
                        $finalFilteredUsers[]=$user;
                    }
                }
            }else{
                $finalFilteredUsers[]=$user;
            }
        }
        
        $dataResponse['request']=$arr;
        $dataResponse['people']=$finalFilteredUsers;
        return $dataResponse;
    }
}
