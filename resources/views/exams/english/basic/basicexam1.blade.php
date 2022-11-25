<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Basic Exam 1</title>


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



$question[]="1. -----am a student.";
$answer[]=["a. He","b. She","c. I"];

$question[]="2. It is ----- orange.";
$answer[]=["an","a","the"];

$question[]="3. A:  Hello! <br> B: ----";
$answer[]=["a. Hi.","b. Good night.","c. Have a nice day."];

$question[]="4. Maung Maung is my brother. He ----- 4 years old.";
$answer[]=["a. is","b. are","c. am"];

$question[]="5. Daw Theingi is my mother. ----- is a housewife.";
$answer[]=["a. They","b. She","c. He"];

$question[]="6. A: What do you do? <br> B: -----";
$answer[]=["a. I am 30 years old.","b. I am a teacher.","c. I like cakes."];

$question[]="7. Si Si and Ni Ni are friends. ----- are students.";
$answer[]=["a. She","b. I","c. They"];

$question[]="8. Myanmar ----- a small country.";
$answer[]=["a. am","b. is","c. are"];

$question[]="9. The moon ----- around the earth.";
$answer[]=["a. rotated","b. rotating ","c. rotates"];

$question[]="10. Si Si ----- my house yesterday.";
$answer[]=["a. visits","b. visited","c. visiting"];

$question[]="11. My sister is ----- right now.";
$answer[]=["a. study","b. studies","c. studying"];

$question[]="12. She is a ----- girl.";
$answer[]=["a. beautiful","b. more beautiful","c. most beautiful"];

$question[]="13. There are 10 ----- in the basket.";
$answer[]=["a. egg","b. apples","c. apple"];

$question[]="14. Nyi Nyi is ----- than Maung Maung.";
$answer[]=["a. tall","b. taller","c. tallest"];

$question[]="15. I didn't eat much ----- .";
$answer[]=["a. rice","b. rices","c. water"];

$question[]="16. A: See you later. <br> B: -----";
$answer[]=["a. Yes, please.","b. Good evening.","c. Good bye!"];

$question[]="17. Cherry Cinema is the ------ cinema in my town.";
$answer[]=["a. big","b. bigger","c. biggest"];

$question[]="18. A: What's your favourite sport? <br> B: -----";
$answer[]=["a. I like jeans.","b. No, I don't.","c. I like volleyball."];

$question[]="19. A: What do you do for fun? <br> B: I like to go ----- .";
$answer[]=["a. swimming","b. doctor","c. hamburger"];

$question[]="20. My mother ----- for us everyday.";
$answer[]=["a. cook","b. cooks","c. cooking"];

$question[]="21. There are a ----- pencils.";
$answer[]=["a. much","b. many","c. few"];

$question[]="22. A: Would you like some tea? <br> B: ----- .";
$answer[]=["a. No, thank you.","b. I don't think so.","c. Sorry."];

$question[]="23. We ----- dinner together last night.";
$answer[]=["a. eated","b. ate","c. eaten"];

$question[]="24. A: are you feeling sick. <br> B: ------";
$answer[]=["a. I'm sorry.","b. I have got a toothache.","c. Sure."];

$question[]="25. Don't make a noise! My sister ----- .";
$answer[]=["a. study","b. was studying","c. is studying"];

$question[]="26. It was hot so I ----- the window.";
$answer[]=["a. open","b. opens","c. opened"];

$question[]="27. We ----- to the cinema tonight.";
$answer[]=["a. are going","b. go","c. went"];

$question[]="28. Do you like coffee ----- tea?";
$answer[]=["a. and","b. or","c. so"];

$question[]="29. Our class starts ----- 9 am.";
$answer[]=["a. at","b. on","c. in"];

$question[]="30. I go to school ----- eating my breakfast.";
$answer[]=["a. and ","b. after ","c. so"];

$question[]="31. I ----- go to the club because I don't like noisy music.";
$answer[]=["a. always","b. sometimes","c. never"];

$question[]="32. She was 22 years old ----- 2016 .";
$answer[]=["a. on","b. in","c. at"];

$question[]="33. They are speaking ----- .";
$answer[]=["a. loud","b. louder","c. loudly."];

$question[]="34. Let's throw a party ----- Sunday.";
$answer[]=["a. at ","b. on ","c. in"];

$question[]="35. It ----- on comming Thursday.";
$answer[]=["a. rain","b. rains","c. will rain"];

$question[]="36. The team ----- won the match.";
$answer[]=["a. easily ","b. easy","c. ease"];

$question[]="37. ----- you text me tomorrow?";
$answer[]=["a. Are","b. Will","c. Do"];

$question[]="38. I ----- tell anyone.I promise.";
$answer[]=["a. didn't ","b. won't","c. don't"];

$question[]="39. Si Si goes to school ----- bus.";
$answer[]=["a. in","b. on","c. by"];

$question[]="40. I can speak ----- .";
$answer[]=["a. Spain","b. Spanish","c. England"];

$question[]="41. She is angry -----she is silent.";
$answer[]=["a. but ","b. because ","c. before"];

$question[]="42. Let's go ----- the park.";
$answer[]=["a. at","b. on","c. to "];

$question[]="43. You need to do exercise ----- you want to lose weight.";
$answer[]=["a. so","b. and","c. if"];

$question[]="44. This is an ----- dress.";
$answer[]=["a. easy ","b. elegant","c. comfortable"];

$question[]="45. Nyi Nyi lives in a ----- mansion.";
$answer[]=["a. attractive ","b. homely","c. huge"];

$question[]="46. I bought milk ----- the market.";
$answer[]=["a. from","b. on","c. to"];

$question[]="47. There are lamp-posts ----- the street.";
$answer[]=["a. along","b. on","c. in"];

$question[]="48. Today is a  ----- and sunny day.";
$answer[]=["a. cold","b. hot","c. humid"];

$question[]="49. She is brushing her teeth ----- the mirror.";
$answer[]=["a. in front of","b. behind","c. above"];

$question[]="50. Our field trip was very ----- and we had a great time.";
$answer[]=["a. interesting ","b. boring","c. Tiring"];




function questionFormatThree($question, $answer,$no){
 
    echo  $question."<br>";

    echo "<div class='row'>";

    for($i=0;$i<count($answer);$i++){
        $ansNo=$i+1;
        echo "
            <div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='$no' id='ans$no$ansNo'>
                    <label class='form-check-label' for='ans$no$ansNo'>
                    <span id='right$no$ansNo'>$answer[$i]  </span>
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
    <h4 align="center">Easy English - Basic Exam 1</h3>

    <span >Allowed Time - 15 min</span>
    <span style="float:right">Marks - 50</span>
    <br>
    <br>

    <p align="justify" class="question" >This basic course exam  includes 50 questions to test your English Level. 
                Please do not use dictionary, google and other materials for the exam.</p>
 
    <?php  
        //for question 1 to 10
        for($i=0;$i<50;$i++){
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
        var ansChecker=['13','21','31','41','52','62','73','82','93','102','113','121','132','142','151','163','173','183','191','202','213','221','232','242','253','263','271','282','291','302','313','322','333','342','353','361','372','382','393','402','411','423','433','442','453','461','471','482','491','501'];
        
        function showAnswer(){
            for(var i=0,j=ansChecker.length;i<j;i++){
              var ansSpan =document.getElementById("right"+ansChecker[i]);
              ansSpan.setAttribute('style','background-color:blue;padding:5px;border-radius:3px;color:white; font-weight:bold;');
            }    
        }

        function checkAnswer(){

            var result=0;

            document.getElementById("bt-showAns").setAttribute('Style','');

            for(var i=0,j=ansChecker.length;i<j;i++){
              var ansSpan =document.getElementById("right"+ansChecker[i]);
              ansSpan.setAttribute('style','');
            }  

            for(var i=0;i<50;i++){
                var no=i+1;
                for(var j=1;j<5;j++){
                    var ansInput=document.getElementById("ans"+no+j);
                    if(ansInput!=null){
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
            }

            console.log(result);
            
            document.getElementById("bt-checkAns").setAttribute('style','display:none;');
            showFinalResult(result);
            saveExamResult(result);
            clearInterval(stop);
           
        }

        function showFinalResult(result){
            var finalResult=document.getElementById('final-result');
            if(result<8){
                finalResult.setAttribute('style','background-color:red');
                if(result <1){
                    finalResult.innerHTML="You are basic level. <br> "+result+"/50 mark";
                }else{
                    finalResult.innerHTML="You are basic level. <br> "+result+"/50 marks";
                }
              
           }else if(result>=8 && result<=13){
                finalResult.setAttribute('style','background-color:rgb(255,165,0)');
                finalResult.innerHTML="You are elementary level. <br> "+result+"/50 marks";
           }else if(result>13 && result<=20){
                finalResult.setAttribute('style','background-color:yellow; color:black;');
                finalResult.innerHTML="You are pre-intermediate level. <br> "+result+"/50 marks";
           }else{
                finalResult.setAttribute('style','background-color:green');
                finalResult.innerHTML="You are intermediate level <br> "+result+"/50 marks";
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
            ajax.send("userid=<?php echo $userid?>&major=english&test=basic_exam&result="+result);

        }

        var second=0;
        var timerEle=document.getElementById('timer');
        var stop =setInterval(updateTimer,1000);

        function updateTimer(){
            second++;
           timerEle.innerHTML=formatTime(second);

           if(second==900){
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

