<html>
    <header>
        
        <meta charset="utf-8" />
        <meta
          name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
          crossorigin="anonymous"
        />
        <title>Korea Exam</title>
        
        <style>
            .button{
                padding:20px;
            }
        </style>
    </header>
    <body style="padding:10px">
        
        <h3 class="text-primary">Exams</h3>
        <p>မိမိရဲ့ အရည်အချင်းတွေကို အကောင်းဆုံး စစ်ဆေးနိုင်တစ်ခုတည်းသောနည်းလမ်းကတော့ စာမေပွဲဖြေဆိုခြင်းပဲဖြစ်ပါတယ်။ </p>
        <p>The only way to better test your skills is to take an exam.</p>
        <hr style="height:10px;">
        
        <h6 class="text-primary"><i class="fa fa-mortar-board"></i>Basic Course Exam</h6>
        <!--<p>မိမိရဲ့လက်ရှိ ကျွမ်းကျင်မှုအဆင့် (Level) ကို Level Test Exam တွင် ဝင်ရောက်စစ်ဆေးနိုင်ပါသည်။</p>-->
        <p>Total marks - 50</p>
        <p>Allowed Time - 30 min</p>
        <p>စာမေးပွဲဝင်ရောက်ဖြေဆိုရန် Start Exam ကို နှိပ် ပါ။</p>
     
        <a href="{{route('showKoreaBasicCourseExam',1)}}?userid={{$userid}}" style="text-decoration:none"><button class="btn-success rounded">Start Exam</button></a>
        
        <hr style="height:10px;">
            
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
      crossorigin="anonymous"
    ></script>

    </body>
    
</html>