<?php

$check['available']='true';

$check['status']="
**Easy English ရဲ့ Latest Version ကတော့ version3.1.5 ပဲဖြစ်ပါတယ်။

** Easy English ရဲ့  Version 3.1.5 မှာတော့ App Design ပိုင်းကို အဓိက ပြောင်းလဲထားပါတယ်

** အရင် version တွေ ဖြစ်တတ်တဲ့ Error အားလုံးကို ပြင်ဆင်ပေးထားပါတယ်

** Google Service ပါရှိတဲ့ ဖုန်းများအတွက် Speaking Bot တစ်ခု အသုံးပြုနိုင်မှာဖြစ်ပြီး မိမိရဲ့ Speaking Skill  အတွက် 
ထိထိရောက် အသုံးချနိုင်မှာဖြစ်ပါတယ်

** Songs, Video တွေရဲ့ Download စနစ်တွေကို ပိုမိုကောင်းမွန်အောင်ပြင်ဆင်ဆောင်ရွက်ထားပါတယ်။

** VIP user တွေအတွက် downloaded video တွေကို folder လေးတွေခွဲပြီး Management ပြုလုပ်နိုင်အောင် 
ဆောင်ရွက်ပေးထားပါတယ်။

** App ရဲ့ Performance ပိုင်းကို အ‌ version တွေထက် သိသိသာသာပြောင်းလဲထားတာမို့ version 3.1.5 ကို
မဖြစ်အနေ download ရယူ အသုံးပြုဖို့ အကြံပြုလိုပါတယ်

**လတ်တလော မြန်မာပြည်တွင် mobile data အခက်ခဲကြောင့် logIn သို့မဟုတ် Register(signUp) ပြုလုပ်၌ ၍ မရသူများ အနေဖြင့် Pshiphon pro vpn ကို အသုံးပြုပြီး ဝင်ရောက်ပေးဖို့ အကြုံပြုလိုပါတယ်။
";

$check['link']="https://apkpure.com/english-for-myanmar/com.qanda.learnroom";
$check['length']=6800000;

$product[0]['name']="Easy Korean";
$product[0]['des']="Korean Online free course app";
$product[0]['link']="https://play.google.com/store/apps/details?id=com.calamus.easykorean";
$product[0]['thumb']="https://www.calamuseducation.com/appthumbs/kommmainicon.png";

$product[1]['name']="FloDic";
$product[1]['des']="Floating Dicationary that can use for 93 languages including Myanmar";
$product[1]['link']="https://play.google.com/store/apps/details?id=com.khtmhk.flodic";
$product[1]['thumb']="https://www.calamuseducation.com/appthumbs/ic_flodic.png";

$product[2]['name']="Russian For Myanmar";
$product[2]['des']="Dictionary and Blog App";
$product[2]['link']="https://play.google.com/store/apps/details?id=com.moekaung.rummdictionary";
$product[2]['thumb']="https://www.calamuseducation.com/appthumbs/rumm.png";

$product[3]['name']="Корейский язык";
$product[3]['des']="Корейский язык для русскоязычных";
$product[3]['link']="https://play.google.com/store/apps/details?id=com.kiloromeo.russiankorea";
$product[3]['thumb']="https://www.calamuseducation.com/appthumbs/russiakoreamain.png";

 

//$app=json_encode($product);
$check['apps']=$product;
echo json_encode($check);

?>