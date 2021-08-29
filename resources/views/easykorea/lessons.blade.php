@extends('layout.app')
 
@section('content')

<div class="row">
    <div class="col-md-10  hidden-sm hidden-xs col-md-offset-1 col-sm-offset-1 col-xs-offset-0" style="background-color:#ddd">
        <div id="wordday">
            <img src="{{$words[0]->thumb}}" width="160px" height="90px" ><br>
            <P style=" color:white; background-color:red">{{$words[0]->korea}} ( {{$words[0]->speech}} ) {{$words[0]->myanmar}}</P>
            <p>{{$words[0]->example}}</p>
        </div>
 
    </div>
</div>
    
<div class="row">

            
    <div class="col-md-4 hidden-sm hidden-xs col-md-offset-1 col-sm-offset-1 col-xs-offset-0" style="background-color:#ddd">
        
        
        
            <a href="{{route('korealessonlist','basic_word_construction')}}">
                <div id="courseItem">
                   <img src="{{ asset ('public/assets/img/basic_word_construction.png')}}" width="40px" > Basic Word Construction
                </div>
            </a>
            
            <a href="{{route('korealessonlist','basic_writing')}}">
                <div id="courseItem">
                    <img src="{{ asset ('public/assets/img/basic_writing.png')}}" width="40px" > Writing
                </div>
            </a>
         
           
            <a href="{{route('korealessonlist','basic_grammar')}}">
                <div id="courseItem">
                   <img src="{{ asset ('public/assets/img/basic_grammar1.png')}}" width="40px" > Grammar
                </div>
            </a>
            
            <a href="{{route('korealessonlist','basic_speaking')}}">
                <div id="courseItem">
                    <img src="{{ asset ('public/assets/img/basic_speaking.png')}}" width="40px" > Speaking
                </div>               
            </a>
            
            <a href="{{route('korealessonlist','basic_reading')}}">
                  <div id="courseItem">
                   <img src="{{ asset ('public/assets/img/basic_reading.jpg')}}" width="40px"  > Reading
                </div>             
            </a>
            
            <a href="{{route('korealessonlist','basic_listening')}}">
            <div id="courseItem">
                <img src="{{ asset ('public/assets/img/listening.png')}}" width="40px" > Listening
            </div>             
            </a>
        
        
        <hr>
        
        <br>
        
        <div id="courseMain">
            <h4 align="center" id="courseHeader">Additional Lessons</h4> 
        </div> 
     <Br>
        <a href="{{route('korealessonlist','Tips and Slang')}}">
            <div id="courseItem">
                  <img src="{{ asset ('public/assets/img/tip_and_slang.png')}}" width="40px" > Tips and Slang
            </div>           
        </a>
        
        <a href="{{route('korealessonlist','Words on Topics')}}">
            <div id="courseItem">
                    <img src="{{ asset ('public/assets/img/word_on_topic.png')}}" width="40px" > Words on Topics
            </div>                      
        </a>
        
        <a href="{{route('korealessonlist','Phrase')}}">
            <div id="courseItem">
                   <img src="{{ asset ('public/assets/img/general_note.png')}}" width="40px" > Phrase
            </div>                    
        </a>
         
        
    </div>

     <div class="col-md-6 col-sm-12 col-xs-12  col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="background-color:#eee">
            @foreach ($lessons as $lesson)
           
           
                @if($lesson->isVideo==1)
                <a href="{{route('videoactivity',$lesson->id)}}">
                    <div id="lessonItem">
                        <img src="https://img.youtube.com/vi/{{$lesson->link}}/0.jpg"width="50px" style="margin-right:20px">
                        {{$lesson->title}}
                         
                    </div>
                </a>  
                @else
                <a href="{{route('detailactivity',$lesson->id)}}">
                    <div id="lessonItem">
                        <img src="{{ asset ('public/assets/img/easykorea.png')}}" width="50px" style="margin-right:20px">
                        {{$lesson->title}}
                         
                    </div>               
                 
                </a>
                @endif
                
             @endforeach
             
 
        </div>
          
</div>
@endsection