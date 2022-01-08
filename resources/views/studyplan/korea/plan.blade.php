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
    <body style="padding:5px;background-color:white">
        
        
        @for($i=0;$i<count($plans);$i++)
       
       <div style="background-color:#E7F3FF;padding:1px; margin-top:2px;margin-bottom:2px; border-radius:2px;">
            @if($i==0)
                <h4 class="text-primary"><i class="fa fa-mortar-board"></i> {{"Day - ".$plans[$i]->day}} </h4>
            @elseif($i>0 and $plans[$i-1]->day!=$plans[$i]->day)
                <h4 class="text-primary"><i class="fa fa-mortar-board"></i> {{"Day - ".$plans[$i]->day}} </h4>
            @endif
            
            <div style="width:100%; margin-top:2px;margin-bottom:2px;padding:5px; background-color:white">
                <div style="font-size:16px; margin-bottom:15px;">
                     {{$plans[$i]->lesson_title}} 
                </div>
                
                <div align="right" style="font-size:10px; font-weight:bold; margin-bottom:3px;color:rgb(150,150,150)">
                    <i>{{$plans[$i]->course_title}}  </i>
                </div>
                
            </div>
            
           
        </div>    
        @endfor
            
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