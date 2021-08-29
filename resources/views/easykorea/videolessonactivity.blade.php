@extends('layout.app')
@section('content')

@php
date_default_timezone_set('Asia/Kolkata'); 
@endphp

<div class="row">

            
    <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0" style="background-color:#eee">
        <br>
        <iframe src="https://www.youtube.com/embed/{{$lessonData->link}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
        style="width:100% ; height:200px"></iframe>     
        
        <div>
            
            <hr style="background-color:#000">
            
            <h5>{{$lessonData->title}}</h5>
            
            @if($post->view_count==0)
                <p>No View</p>
            @elseif($post->view_count==1)
                <p>{{$post->view_count}} view</p>
            @else
                <p>{{$post->view_count}} views</p>
            @endif
           
            
             <hr style="background-color:#000">
    
            
            <img src="{{ asset ('public/assets/img/easykorea.png')}}" style="width: 30px; height:30px; margin-right:4px; border-radius :50%; border: solid 2px white;">
            
            Calamus Education
               <?php 
                    $s = $post->post_id/ 1000;
                    $d= date("d/M/Y", $s);
                    
                ?>
            
            <p align="right">
                Posted on - {{$d}}
            </p>
         
        </div>
         <br>
        
    </div>

    <div class="col-md-4 col-sm-10 col-xs-12 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="background-color:#fff">
        <br>
        <h5 align="center">
             @if($post->comments==0)
                <p>No Comment</p>
            @elseif($post->comments==1)
                <p>{{$post->comments}} Comment</p>
            @else
                <p>{{$post->comments}} Comments</p>
            @endif
        </h5>
        
        
        @foreach ($comments as $comment)
           
         <div style="display:flex;">
		
            <div >
                <img src="{{$comment->userImage}}" style="width: 30px; height:30px; margin-right:4px; border-radius :50%; border: solid 2px white;">
            </div>
	
		
            <div style ="background-color:#F0F3F5; padding:5px;border-radius: 6px 20px 12px; ">
                
                <div  style="font-weight:bold;color:#405d9b;	padding-top:3px;" >
                      {{$comment->userName}}
                
                 </div>
                 
                <div  style="padding-top:5px;" >
                    
                    {{$comment->body}}
                    
                </div>
                 
                			    	
                <span style="color :#999; padding-top:3px; margin-bottom:5px;">
                <?php 
                    $s = $comment->time/ 1000;
                    $d= date("d/M/Y", $s);
                    echo $d;
                ?>
                </span>
                
            </div>
		
        </div>
        <br>
        @endforeach
        
       
         
    </div>
          
</div>

 
   
@endsection
