<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\learner;
use Hash;

class PasswordController extends Controller
{
      public function searchAccount(Request $req){
        
        $major=$req->appname;
        $phone=$req->phone;
        
        $result=learner::where('learner_phone',$phone)->first();
        if($result){
            
            $email=$result->learner_email;
            if($email!=""){
                
                //send email
                $code=substr(time(),6,10);
                learner::where('learner_phone',$phone)->update(['otp'=>$code]);
                mail($email,$major,$code,"Confirmation code");
            
                $hiddenEmail=substr($email,0,4)."******.com";
                $response['code']="50";
                $response['msg']=$hiddenEmail." email သို့ အတည်ပြု code အား ပေးပို့ထားပြီး ဖြစ်ပါသည်။ ပေးပို့လိုက်သော အတည်ပြု code အား အောက်တွင်ထည့်၍ CONFIRM CODE ကို နှိပ်ပါ။";
                return $response;
                
            }else{
                $response['code']=52;
                
                $response['msg']="သင်၏ account တွင် ယခင်က email ထည့်သွင်းထားခြင်းမရှိသောကြောင့် password reset မပြုလုပ်နိုင်ပါ။ ထို့ကြောင့် ".$major." Facebook သို့ ဆက်သွယ် အကူအညီတောင်းခံနိုင်ပါသည်။ ";
                
                return $response;
            }
            
          
        }else{
            $response['code']=51;
            $response['msg']="ယခုထည့်သွင်းလိုက်သော ဖုန်းနံပါတ်ဖြင့် account ပြုလုပ်ထားခြင်းမရှိပါ။ အခြားသော ဖုန်နံပါတ်ကို အသုံးပြု၍ နောက်တစ်ကြိမ်ပြန်လည်ကြိုးစားကြည့်ပါ။";
            return $response;
        }
    }
    
    
    public function verifyEmail(Request $req){
        
        $phone=$req->phone;
        $code=$req->code;
        
        $user=learner::where('learner_phone',$phone)->first();
    
        $otp=$user->otp;
     
        if($otp==$code and $code!=0){
            $response['code']="50";
            $response['msg']="သင်၏ password အသစ်ကို ရိုက်ထည့်ပါ။";
            
        }else{
            $response['code']="51";
            $response['msg']="code နံပါတ် မှားယွင်းနေပါသည်..";
        }
        
        return $response;
    }
    
    public function resetPasswordByCode(Request $req){
        
        $phone=$req->phone;
        $code=$req->code;
        $password=$req->newPassword;
        
        $user=learner::where('learner_phone',$phone)->first();
        $otp=$user->otp;
        
        if($otp==$code and $code!=0){
            
            $pw=Hash::make($password);
            learner::where('learner_phone',$phone)->update(['password'=>$pw]);
            
            $response['code']="50";
            $response['msg']="သင့် account ၏ password အား အသစ်ပြင်ဆင်သတ်မှတ်ပြီးပါပြီ။ account သို့ ဝင်ရောက်လိုပါက LOGIN ကို နှိပ်ပါ။";
            $response['password']=$password;
            
        }else{
            $response['code']="51";
            $response['msg']="Error";
           
        }
        
        return $response;
    }
    
    
    
    public function checkCurrentPassword(Request $req){
        
        $phone=$req->phone;
        $password=$req->password;
        
        $user=learner::where('learner_phone',$phone)->first();
        if($user){
            if(Hash::check($password, $user->password)){
    		        $response['code']= "50";
    		        $response['msg']= "သင့်၏ password အသစ်ကို ထည့်ပါ ။";
    		}else{
    		        $response['code']= "51";
    		        $response['msg']= "password မှားယွင်းနေပါသည်။ နောက်တစ်ကြိမ်ပြန်လည်ကြိုးစားကြည့်ပါ။";
    		}   
        }
        
        return $response;
    }
    
    
    public function resetPasswordByUser(Request $req){
        
        $phone=$req->phone;
        $currentPassword=$req->currentPassword;
        $newPassword=$req->newPassword;
        
        $user=learner::where('learner_phone',$phone)->first();
    
        if(Hash::check($currentPassword, $user->password)){
            
            $pw=Hash::make($newPassword);
            learner::where('learner_phone',$phone)->update(['password'=>$pw]);
            
            $response['code']="50";
            $response['msg']="သင့် account ၏ password အား အသစ်ပြင်ဆင်သတ်မှတ်ပြီးပါပြီ။";
      
            
        }else{
            $response['code']="51";
            $response['msg']="Error";
           
        }
        
        return $response;
    }
}
