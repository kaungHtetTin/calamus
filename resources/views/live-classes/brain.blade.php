<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Calamus Education</title>
    <style>
         .button{
                padding:20px;
            }
            
        .bg-header{
            padding:7px;
            color:white;
        }

        .msg{
            color: white;
            padding:7px;
            border-radius:3px;
        }

        .centered{
            text-align: center;
        }

        h6{
            color: #777
        }

        p{
            text-align: justify;
        }

        a{
            text-decoration: none;
        }

    </style>
</head>

<body>
  <div class="container">

       <div class="bg-header">

            <div style="display: flex;   background:#FF8719;">
                <div style="margin-right: 30px; margin-left:10px;">
                    <img src="https://calamuseducation.com/uploads/icons/easykorean_basic_course.png" style="height:150px; margin-bottom:-30px;
                    "/>
                </div>
                
                <div style="">
                    <br>
                    <h5>Learning And Brain Live Class</h5>
                    Only For Gold Plan Members <br>
                    2 hrs <br>
                </div>
            </div> 
            
         </div>
         <br><br>
        {{-- @if (!session('link'))
            <h4>Register Now</h4>
            <p> Calamus Education တွင် Register လုပ်ထားသော Account ၏ ဖုန်းနံပါတ်ကို အသုံးပြု၍ စာရင်းပေးသွင်းပါ။
            </p>

            @if(session('err'))
                <div class="bg-danger msg">
                {{session('err')}}
                </div>       
            @endif
    

            <form action="{{route('registerBrainTrainingClass')}}" method="post">
                @csrf
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" id="phone-number" placeholder="Enter phone number"
                    @if (isset($userid))
                        value="{{$userid}}"
                    @endif
                    >
                    <p class="text-danger" style="font-size: 12px;">{{$errors->first('phone')}}</p>
                </div>
    
                <button type="submit" class="btn btn-primary">Register</button>
            </form>        
        @else
            <div class="bg-success msg">
               စာရင်းပေးသွင်းမှု အောင်မြင်ပါသည်။ အောက်တွင် ဖော်ပြထားသော Telegram Group ကို Join ပေးပါ။ Zoom, Google Meet , Telegram Group တစ်ခုခုမှ သတ်မှတ်ရက် သတ်မှတ်အချိန်တွင်
               ဆွေးနွေးပို့ချသွားမည်ဖြစ်ပြီး Meeting Inviting Link ကို အောက်ပါ Telegram Group တွင် အချိန်နှင့် တပြေးညီ ပေးပို့သွားမည် ဖြစ်ပါသည်။
            </div>

            <br><br>

            <div style="display: flex">

                <div style="padding:7px; background-color:rgb(230, 230, 230); border-radius:3px;width:80%">
                        {{session('link')}} 
                </div>

                <a href="{{session('link')}}" class="btn-primary centered" 
                style="text-decoration: none;width:100px; border-radius:3px; margin-left:5px; ">
                    <span style="vertical-align:middle">Join</span>
                </a>
                
            </div>

        @endif

        <br>
        --}}

        <h4>About Class</h4>
        <ul>
            <li>Learning and Brain Live Class ကို Calamus Education မှ Gold Plan Member ဝင်များအတွက် သင်ကြားပေးသွားမှာ ဖြစ်ပါတယ်။</li>
            <li>သင်ကြားချိန် ၂ နာရီကြာမြင့်မှာဖြစ်ပါတယ်</li>
            <li>ဦးနှောက်ဉာဏ်ရည်နဲ့ ပတ်သက်ပြီး အဓိက သင်ကြားရမှာဖြစ်ပါတယ်</li>
            <li>ပညာရပ်တစ်ခုကို ကျွမ်းကျင်အောင်ဘယ်လို လေ့လာရမယ်ဆိုတဲ့ Learning Tips လေးတွေလည်း ဆွေးနွေးပို့ချပေးသွားမှာပါ။ </li>
        </ul> 

        <h4>Course Outline</h4>
        <ol class="list-group list-group-numbered">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><b>Self Learning</b></div>
                    Self-Learning ဟာ ဘာကြောင့်အရေးကြီးတာလဲ
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><b>Rules Of 5</b></div>
                    ပညာရပ်တစ်ခုကိုဖြစ်မြောက်သည်အထိ လေ့လာရန် လိုအပ်သောစည်းမျဉ်း ၅ ခု
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><b>How Brain Works</b></div>
                    ဦးနောက်အလုပ်လုပ်ပုံနှင့် ဉာဏ်ရည်တိုးတက်အောင် ဘာတွေလုပ်ရမလဲ
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><b>Memory</b></div>
                    အလွယ်တကူနဲ့ ရေရှည်မှတ်မိစေနိုင်တဲ့ နည်းလမ်းတွေက ဘာတွေဖြစ်မလဲ
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><b>Subconscious Mind</b></div>
                    မသိစိတ်က တက်မြောက်အောင် ဘယ်လို လေ့လာမလဲ
                </div>
            </li>
           
        </ol>

        <br>

        <h4>Represented By</h4>
        <div>
            <div style="display: flex;">
                <div style="margin-right: 20px;">
                    <img src="https://www.calamuseducation.com/uploads/images/kht-photo.png" style="height:100px; width:100%; border-radius:50%"/>
                </div>
                
                <div style="">
                    <h5>Ko Kaung Htet Tin</h5>
                    <h6>M.Sc. (Physics) </h6>
                    <h6>Founder & Developer </h6>
                    <h6>Calamus Education </h6>
                     
                </div>
            </div> 
        </div>

        <br><br><br>
  </div>
    
</body>

</html>