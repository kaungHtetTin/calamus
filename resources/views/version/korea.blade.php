<?php

$check['available']='true';

$check['status']="
** Easy Korean ရဲ့ နောက်ဆုံးထွက်ရှိထားတဲ့ version ကတော့ version 2.19 ပဲ ဖြစ်ပါတယ်
** Chat message ပို့တဲ့ အခါ ပို့တဲ့သူဘက်မှာ message တွေ အထပ်ထပ်ပေါ်နေတာမျိုးကို ဖြေရှင်း‌ေပးထားပါတယ်။
** မိမိရှာဖွေလိုသော အကြောင်းအရာ (Discussion Posts) များနှင့် မိမိသူငယ်ချင်း နာမည်ကို ရိုက်ထည့်၍ ရှာဖွေနိုင်မှာဖြစ်ပါတယ်။

";

$check['link']="https://www.mediafire.com/file/xib3jely3vaugy1/Easy+Korean+v2.19.apk/file";
$check['length']=6800000;

$product[0]['name']="Easy English";
$product[0]['des']="English Online free course app";
$product[0]['link']="https://play.google.com/store/apps/details?id=com.qanda.learnroom";
$product[0]['thumb']="https://www.calamuseducation.com/appthumbs/eemainicon.png";

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