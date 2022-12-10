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
        <title>Study Plan</title>
        
        <style>
            .button{
                padding:20px;
            }
            
            .bg-header{
                padding:7px;
                background:{{$course->background_color}};
                color:white;
            }
            
            .day-plan{
                margin:3px;
                border-radius:5px;
                width:100%;
               
            }
        </style>
    </header>
    <body style="padding:5px;background-color:white">
       
       <div class="container">
         <div class="bg-header">
          
            
            <div style="display: flex;">
                <div style="margin-right: 20px;">
                    <img src="{{$course->cover_url}}" style="height:100px;"/>
                </div>
                
                <div style="">
                  
                    <h5>{{$course->title}} - Detail</h5>
                    {{$course->description}} <br>
                    {{$course->duration}} Days <br>
                </div>
                
            </div> 
            
         </div>
          
        <div class="row">
            
            @for($i=0;$i<count($plans);$i++)
            @php
            $day=$i+1;
            $lessons=$plans[$i];
            $duration=0;
            
            
            @endphp
            
            <div class="col-lg-6 col-sm-12 col-xs-12">
             <div class="day-plan card">
               
               <div style="padding:5px">
                    <h6 class="card-title" style="color:{{$course->background_color}}">Day {{$day}}</h6>
                 
                    <ul style="font-size:12px">
        
                        @foreach($lessons as $lesson)
                        @php
                            $duration+=$lesson->duration;
                        @endphp
                        
                        <li>{{$lesson->lesson_title}} </li>
                         
                        @endforeach
                    </ul>
                    
               </div>
             </div>
            
            </div>
            
            @endfor
            
    </div>
       
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