
@extends('layout.app')
 
@section('content')

<div class="row">
    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0" style="background-color:#ddd">
        <div id="wordday">
            <img src="{{ asset ('public/assets/img/grammar.png')}}" width="160px" height="90px" ><br>
            <P style=" color:white; background-color:red">Cat (n) ေကျာင္</P>
            <p>What a big cat!</p>
        </div>
 
    </div>
</div>
    
<div class="row">
            
    <div class="col-md-4 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0" style="background-color:#ddd">
        
        <div id="courseMain">
            <h4 align="center" id="courseHeader">Additional Lessons</h4> 
        </div> 
     <Br>
        <div id="courseItem">
               <img src="{{ asset ('public/assets/img/basic_word_construction.png')}}" width="40px" > Tips and Slang
        </div>
   
        <div id="courseItem">
                <img src="{{ asset ('public/assets/img/basic_writing.png')}}" width="40px" > Words on Topics
        </div>
      
        <div id="courseItem">
               <img src="{{ asset ('public/assets/img/grammar.png')}}" width="40px" > Phrase
        </div>
        
    </div>

     <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="background-color:#eee">
            @foreach ($lessons as $lesson)
            <div id="lessonItem">
               <img src="{{ asset ('public/assets/img/grammar.png')}}" width="50px" style="margin-right:20px">{{$lesson->title}}
            </div>
             @endforeach
 
        </div>
          
</div>
@endsection