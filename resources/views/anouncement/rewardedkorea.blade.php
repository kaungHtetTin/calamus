<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
      crossorigin="anonymous"
    />
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <title>Hello, world!</title>
    <style>
        hr {
           margin:10px; 
        }
        
        .users{
            margin:4px 4px 20px 4px;
            border-radius:3px;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);
        }
        
        
        
        .cate{
            background-color:rgb(187, 222, 251);
            padding:10px;
            font-weight:bold;
            font-size:16px;
        }
        
        .userImg{
            width:40px;
            height:40px;
            border-radius:50%;
            margin-right:5px;
        }
        
        .userList{
            margin:3px;
            padding:3px;
        }
        
    </style>
  </head>
  <body >
    <div >

        <div class="">
            <div class="cate">
                <i class="material-icons">school</i> ကြိုးစားအားထုတ်မှုအကောင်းဆုံးဆု
                
            </div>
        
            @foreach($learners as $learner)
                
                <div class="userList">
                    <img src="{{$learner->image}}" class="userImg"> <b>{{$learner->name}} </b>
                </div>
                
            @endforeach
    
            <p class="text-primary" style="padding:15px; text-align:justify;">
*** ဆုရရှိသူများအား Easy Korean မှ phone bill 2000 MMK ချီးမြင့်ပေးမည်ဖြစ်ပါသဖြင့်
Easy Korean Developer Group သို့ ဆက်သွယ်ပေးပါရန် ***
            </p>
  
        </div>
        
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
