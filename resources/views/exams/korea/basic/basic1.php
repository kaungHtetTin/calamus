<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Basic Exam</title>


    <style>
        .image{
            width: 100%;
            height: auto;
           
            align-self: center;
        }
        .warnPara{
          
            text-align: justify;
            background-color: bisque;
            padding: 10px;
            border-radius: 5px;
        }
        body{
            padding: 20px;
        }

        button{
            flex: 1;
            margin: 5px;
        }
        .answer{
            color: white;
            background-color: rgb(0, 201, 27);
            padding: 5px;
            border-radius: 2px;
            margin-right: 10px;
            
        }
        .question{
            background-color:rgb(0, 140, 233);
            border-radius: 3px;
            padding: 10px;
            color:white;
            font-weight:bold;
        }
        #final-result{
            padding: 7px;
            border-radius:3px;
            margin:15px;
            font-weight:bold;
            font: size 20px;
            text-align:center;
            color:white;
        }

        .fixedTime{
            padding:5px;
            border-radius:3px;
            background-color:green;
            color:white;
        }

    </style>

</head>

<?php

//question  1 to 10
$question[] ="1. 눈이 나쁩니다. ( ...... )을 씁니다. ";
$answer[]=["사전","수박","안경","지갑"];

$question[]="2. 저는 ( ...... ) 에 갑니다. 밥을 먹습니다.";
$answer[]=["식당","서점","학교","회사"];

$question[]="3. 비가 옵니다. 하지만 ( ...... ) 이 없습니다.";
$answer[]=["가방","우산","책","모자 "];

$question[]="4. 우리 언니는 모델입니다. 키가 ( ...... ) 큽니다. ";
$answer[]=["아주","아직","가끔"," 먼저"];

$question[]="5. 저는 사과를 좋아합니다. 그래서 ( ...... ) 먹습니다. ";
$answer[]=["아마","가장","보통","자주"];

$question[]="6.  오빠가 아직 안 옵니다. 오빠를 ( ...... ).";
$answer[]=["있습니다","기다립니다","보냅니다","가르칩니다"];

$question[]="7. 주스가 없습니다. 그래서 물을 ( ...... ).";
$answer[]=["합니다","모릅니다","좋습니다"," 마십니다"];

$question[]="8. 도서관입니다. 책이 아주 ( ...... ).";
$answer[]=["많습니다","넓습니다","쉽습니다","가볍습니다"];

$question[]="9. 친구의 생일입니다. 그래서 친구들과 같이 사진을( ...... ).";
$answer[]=["만납니다","빌립니다","찍습니다","배웁니다"];

$question[]="10. 저는 매일 밤 12 시에 잡니다. 아침 7시에 ( ...... ).";
$answer[]=["옵니다","갑니다","일어납니다","먹습니다"];

//question 11 to 20
$question[]="11. 시장에 갑니다. 고기 ( ...... ) 채소를 삽니다.";
$answer[]=["과","만","하고","도"];

$question[]="12. 커피를 좋아합니다. 우유  ( ...... ) 좋아합니다. ";
$answer[]=["는","도","를","가"];

$question[]="13. 저녁을 ( ...... ) 텔레비전을 봅니다. ";
$answer[]=["먹지만","먹으러","먹으니까","먹고"];

$question[]="14. 저는 미국에 있습니다. 부모님  ( ...... ) 한국에 있습니다.";
$answer[]=["은","하고","는","도"];

$question[]="15. 친구들을 파티에   ( ...... ) 싶습니다.";
$answer[]=["초대하고","가르치고","기다리고","만나고"];

$question[]="16. 한국에는 사계절   ( ...... ) 있습니다.";
$answer[]=["이","은","는","가"];

$question[]="17. 지금 비가 ( ...... ) 너무 덥습니다.";
$answer[]=["오니까","오면","오고","오지만"];

$question[]="18. 집 근처 ( ...... ) 백화점이 없습니다.";
$answer[]=["고","하고","에","는"];

$question[]="19. 축구 ( ...... ) 좋아하는 사람들이 많습니다.";
$answer[]=["를","을","도","에"];

$question[]="20. 수업이   ( ...... ) 전화하세요.";
$answer[]=["끝나지만","끝나면","끝나서"," 끝나려고"];

//question no 21 to 30

$question[]="21-students.jpg";
$answer[]=["가수","학생","요리사","회사원"];

$question[]="22-park.jpg";
$answer[]=["공원","도서관","회사","학교"];

$question[]="23-spa.jpg";
$answer[]=["화장실","사무실","미용실","거실"];

$question[]="24-apple.jpg";
$answer[]=["복숭아","바나나","수박","사과"];

$question[]="25-shoes.jpg";
$answer[]=["시계","구두","책","의자"];

$question[]="26-grape.jpg";
$answer[]=["망고","토마토","딸기","포도"];

$question[]="27-family.jpg";
$answer[]=["아버지","어머니","가족","동생"];

$question[]="28-korea.jpg";
$answer[]=["중국","일본","태국"," 한국"];

$question[]="29-ring.jpg";
$answer[]=["귀걸이","반지","팔찌","목거리"];

$question[]="30-green.jpg";
$answer[]=["초록색","빨간색","노란색","파란색"];

//question no 31 to 40

$question[]="31. 딸기를 먹습니다. 딸기가 맛있습니다. ";
$answer[]=["날씨","과일","생일","공부"];

$question[]="32. 저는 김예원입니다. 이 사람은 최수빈입니다.";
$answer[]=["나이","이름","가족","시간"];

$question[]="33. 내일은 토요일입니다. 놀이공원에 가겠습니다.";
$answer[]=["계획","날짜","약속","장소"];

$question[]="34. 오빠가 있습니다. 언니도 있습니다.";
$answer[]=["취미","직업","친구","가족"];

$question[]="35. 한국에는 봄, 여름, 가을, 겨울이 있습니다. 지금은 겨울입니다.";
$answer[]=["날씨","나라","계절","휴일"];

$question[]="36. 오늘은 7월 1일입니다. 내일은 7월 2일입니다.";
$answer[]=["날짜","방학","하루"," 아침"];

$question[]="37. 오늘은 하늘이 맑습니다. 덥지 않습니다. ";
$answer[]=[" 주말","날씨","봄","구름"];

$question[]="38. 아버지는 의사입니다. 어머니는 선생님입니다.";
$answer[]=["학교","병원","집","직업"];

$question[]="39. 누나는 미국에 있습니다. 저는 한국에 있습니다.";
$answer[]=["나라","방학","여행","장소"];

$question[]="40. 운동을 좋아합니다. 친구들과 농구를 자주 합니다.";
$answer[]=["공부","시간","취미","쇼핑"];

//question no 41 to 50
$question[]="회사원입니까?";
$answer[]=["아니요, 변호사입니다.","네, 회사원이 아닙니다.","아니요, 회사원입니다.","네, 대학생입니다."];

$question[]="책이 있어요?";
$answer[]=["네, 책이 많아요.","아니요, 책이 없어요.","네, 책을 좋아해요.","아니요, 책을 읽어요."];

$question[]="지금 무엇을 먹어요?";
$answer[]=["자주 먹어요.","집에서 먹어요.","언니하고 먹어요.","김밥을 먹어요."];

$question[]="맛있게 드세요.";
$answer[]=["좋겠습니다.","잘 먹겠습니다.","모르겠습니다.","죄송합니다."];

$question[]="생일 축하해요.";
$answer[]=["고마워요.","미안해요.","괜찮아요.","반가워요."];

$question[]="안녕히 계세요.";
$answer[]=["안녕히 계세요","들어가세요.","안녕히 가세요.","어서 오세요."];

$question[]="영화를 봐요?";
$answer[]=["네, 영화를 해요.","네, 영화가 아닙니다.","아니요, 영화가 재미있어요.","아니요, 영화를 안 봐요."];

$question[]="수업이 어때요?";
$answer[]=["학교에 가요.","수업이 있어요.","아주 재미있어요.","지금 읽어요."];

$question[]="언제 친구를 만나요?";
$answer[]=["학생을 만나요.","동생하고 만나요.","공원에서 만나요.","내일 만나요."];

$question[]="이 빨간색 모자 어때요?";
$answer[]=["아주 예뻐요.","오늘 입어요.","제 모자예요.","어제 샀어요."];


function questionFormatOne($question, $answer,$no){
    echo $question;
   
        echo "<div style='display:flex; margin-top:10px;'>";
        for($i=0;$i<2;$i++){
            $ansNo=$i+1;
            echo "
                <div class='form-check' style='flex:1'>
                    <input class='form-check-input' type='radio' name='$no' id='ans$no$ansNo'>
                    <label class='form-check-label' for='ans$no$ansNo'>
                    <span id='right$no$ansNo'> $ansNo. $answer[$i]  </span>
                    <i id='correct$no$ansNo' class='material-icons' style='font-size:18px;color:rgb(0, 255, 0);display:none;'>check_circle</i>
                    <i id='error$no$ansNo' class='material-icons' style='font-size:18px;color:red;display:none;'>cancel</i>                   
                    </label>
                </div>
            ";
        }
        echo "</div><br>";

        echo "<div style='display:flex;'>";
        for($i=2;$i<4;$i++){
            $ansNo=$i+1;
            echo "
                <div class='form-check' style='flex:1'>
                    <input class='form-check-input' type='radio' name='$no' id='ans$no$ansNo'>
                    <label class='form-check-label' for='ans$no$ansNo'>
                    <span id='right$no$ansNo'> $ansNo. $answer[$i]  </span>
                    <i id='correct$no$ansNo' class='material-icons' style='font-size:18px;color:rgb(0, 255, 0);display:none;'>check_circle</i>
                    <i id='error$no$ansNo' class='material-icons' style='font-size:18px;color:red;display:none;'>cancel</i>                  
                    </label>
                </div>
            ";
        }
        echo "</div>";

    echo "<br><br>";
}


function questionFormatTwo($question, $answer,$no){

    echo $no." .";
    echo " <div style='display:flex'>";
    
    echo " <div style='flex:1;'><img src='$question' style='width:120px; height:90px;border-radius:10px;'></div>";
        echo"<div style='flex: 1;'>";
        for($i=0;$i<4;$i++){
            $ansNo=$i+1;
            echo "
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='$no' id='ans$no$ansNo'>
                    <label class='form-check-label' for='ans$no$ansNo'>
                    <span id='right$no$ansNo'> $ansNo. $answer[$i]  </span>
                    <i id='correct$no$ansNo' class='material-icons' style='font-size:18px;color:rgb(0, 255, 0);display:none;'>check_circle</i>
                    <i id='error$no$ansNo' class='material-icons' style='font-size:18px;color:red; display:none;'>cancel</i>    
                    </label>
                </div>
            ";
        }
        echo "</div>";
    echo "</div><br><br>";
 
}

function questionFormatThree($question, $answer,$no){
    echo $no." .<br>";
    echo "A : ".$question."<br>";
    echo "B : ..............";

    echo "<div class='row'>";

    for($i=0;$i<4;$i++){
        $ansNo=$i+1;
        echo "
            <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='$no' id='ans$no$ansNo'>
                    <label class='form-check-label' for='ans$no$ansNo'>
                    <span id='right$no$ansNo'> $ansNo. $answer[$i]  </span>
                    <i id='correct$no$ansNo' class='material-icons' style='font-size:18px;color:rgb(0, 255, 0); display:none;'>check_circle</i>
                    <i id='error$no$ansNo' class='material-icons' style='font-size:18px;color:red; display:none;'>cancel</i>    
                    </label>
                </div>
            </div>
        ";
    }
    echo "</div><br><br>";
}

?>
 
<body>
<div class="container">

    <div style="position:fixed;right: 10px;;"><span class="fixedTime" id="timer" >Time Left</span></div><br>
    <h3 align="center">Calamus Education</h2>
    <h4 align="center">Easy Korean - Basic Course Exam</h3>

    <span >Allowed Time - 30 min</span>
    <span style="float:right">Marks - 50</span>
    <br>
    <br>
    <p align="justify" class="question" >다음을 보고 빈칸에 들어갈 알맞은 것을 고르십시오. <br/>
    [ အောက်ပါ စာကြောင်းကို ဖတ်ပြီး ကွက်လပ်ထဲ ထည့်ရမယ့် စာလုံးကို ရွေးပါ။]</p>


    <?php  
        //for question 1 to 10
        for($i=0;$i<10;$i++){
            questionFormatOne($question[$i],$answer[$i],$i+1);
        }
    ?>

    <p align="justify" class="question" >다음을 보고 빈칸에 들어갈 알맞은 문법을 고르십시오.<br/>
    [အောက်ပါ စာကြောင်းကို ဖတ်ပြီး ကွက်လပ်ထဲ ထည့်ရမယ့် Grammar ကို ရွေးပါ။]</p>

    <?php  
        //for question 11 to 20
        for($i=10;$i<20;$i++){
            questionFormatOne($question[$i],$answer[$i],$i+1);
        }
    ?>

    <p align="justify" class="question" >다음 사진을 보고 알맞은 어휘를 고르십시오.<br/>  
    [အောက်ပါ ပုံကို ကြည့်ပြီး ပုံနဲ့ ကိုက်ညီတဲ့ စာလုံးကို ရွေးပါ။]</p>

    <?php  
        //for question 11 to 20
        for($i=20;$i<30;$i++){
            questionFormatTwo("https://www.calamuseducation.com/uploads/lessons/images/".$question[$i],$answer[$i],$i+1);
        }
    ?>


    <p align="justify" class="question" > 무엇에 대한 이야기입니까? 알맞은 것을 고르십시오.<br/>  
    [ ဘာအကြောင်းနဲ့ ပက်သက်ပြီး ပြောနေတာလဲ? ကိုက်ညီတဲ့ စကားလုံးကို ရွေးချယ်ပါ]</p>

    <?php  
        //for question 1 to 10
        for($i=30;$i<40;$i++){
            questionFormatOne($question[$i],$answer[$i],$i+1);
        }
    ?>



    <p align="justify" class="question" > 다음 대화를 보고  B  가 이어서 할 말을 고르십시오.<br/>  
    [ အောက်ပါ စကားပြောကို ဖတ်ပြီး B ဆက်ပြောမယ့် စာကြောင်းကို ရွေးပါ။]</p>

    <?php  
        //for question 1 to 10
        for($i=40;$i<50;$i++){
            questionFormatThree($question[$i],$answer[$i],$i+1);
        }
    ?>

    <div style="display:flex;">
        <button id="bt-checkAns" class="btn btn-primary" onClick="checkAnswer()" >Check Answer</button>
        <button id="bt-showAns" class="btn btn-danger" onclick="showAnswer();" style="display:none;">Show Answer</button>
    </div>
   

    <p id="final-result">
      
    </p>

</div>


    <script>
        var ansChecker=["13","21","32","41","54","62","74","81","93","103","113","122","134","141","151","161","174","183","191","202","212","221","233","244","252","264","273","284","292","301","312","322","331","344","353","361","372","384","391","403","411","422","434","442","451","463","474","483","494","501"];
       
        function showAnswer(){
            for(var i=0,j=ansChecker.length;i<j;i++){
              var ansSpan =document.getElementById("right"+ansChecker[i]);
              ansSpan.setAttribute('style','background-color:blue;padding:5px;border-radius:3px;color:white; font-weight:bold;');
            }    
        }

        function checkAnswer(){

            var result=0;

            document.getElementById("bt-showAns").setAttribute('Style','');

            // var inputEle=document.getElementsByTagName('span');
            // for(var i=0,j=inputEle.length;i<j;i++){
            //     inputEle[i].setAttribute('style','');
            // }
           
            for(var i=0,j=ansChecker.length;i<j;i++){
              var ansSpan =document.getElementById("right"+ansChecker[i]);
              ansSpan.setAttribute('style','');
            }  

            for(var i=0;i<50;i++){
                var no=i+1;
                for(var j=1;j<5;j++){
                    var ansInput=document.getElementById("ans"+no+j);
                    var isChecked=ansInput.checked;
                    if(isChecked){
                        var inputId=ansInput.getAttribute("id");
                        if(inputId=="ans"+ansChecker[i]){
                            result++;
                            document.getElementById('correct'+no+j).setAttribute('style','font-size:18px;color:rgb(0, 255, 0);');
                        }else{
                             document.getElementById('error'+no+j).setAttribute('style','font-size:18px;color:red;');
                        }
                    }
                }
            }

            console.log(result);
            
            document.getElementById("bt-checkAns").setAttribute('style','display:none;');
            showFinalResult(result);
            saveExamResult(result);
            clearInterval(stop);
           
        }

        function showFinalResult(result){
            var finalResult=document.getElementById('final-result');
            if(result<20){
                finalResult.setAttribute('style','background-color:red');
                if(result <1){
                    finalResult.innerHTML="Fail <br> "+result+"/50 mark";
                }else{
                    finalResult.innerHTML="Fail <br> "+result+"/50 marks";
                }
              
           }else if(result>=21 && result<=30){
                finalResult.setAttribute('style','background-color:rgb(255,165,0);');
                finalResult.innerHTML="Good <br> "+result+"/50 marks";
           }else if(result>30 && result<=40){
                finalResult.setAttribute('style','background-color:yellow; color:black;');
                finalResult.innerHTML="Very Good <br> "+result+"/50 marks";
           }else{
                finalResult.setAttribute('style','background-color:green');
                finalResult.innerHTML="Excellent <br> "+result+"/50 marks";
           }
        }
        
        function saveExamResult(result){
            var ajax=new XMLHttpRequest();
            ajax.onload=function(){
                if(ajax.status==200 || ajax.readyState==4){
            
                }
            }
            ajax.open("POST","https://www.calamuseducation.com/calamus/api/exam/result/update",true);
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send("userid=<?php echo $userid?>&major=korea&test=basic_exam&result="+result);

        }


        var second=0;
        var timerEle=document.getElementById('timer');
        var stop =setInterval(updateTimer,1000);

        function updateTimer(){
            second++;
           timerEle.innerHTML=formatTime(second);

           if(second==1800){
               clearInterval(stop);
               timerEle.setAttribute('style','background-color:red;');
               checkAnswer();
           }
        }

        function stopExam(){
            var inputRadio=document.getElementsByTagName('input');
            for(var i=0;i<50;i++){
                inputRadio[i].disable=true;
            }
        }

        function formatTime(sec){
            var s=parseInt(sec%60);
            var m =parseInt(sec/60);

            if(m<10){
                if(s <10){
                    return "0"+ m+" : 0"+s;
                }else{
                    return "0"+ m+" : "+s;
                }
            }else{
                if(s <10){
                    return  m+" : 0"+s;
                }else{
                    return  m+" : "+s;
                }
            }
            
        }

    </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>

