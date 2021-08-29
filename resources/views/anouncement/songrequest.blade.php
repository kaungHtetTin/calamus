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
    <title>Hello, world!</title>
    <style>
      #artists_container {
        display: grid;
        grid-template-columns: auto auto;
        grid-column-gap: 20px;
      }
      .artist {
        padding: 10px;
        margin-bottom: 20px;
        border:1px solid gray;
        border-radius:3px;
        color:black;
      }
      .artist:active {
        transform: scale(0.9, 0.9);
      }
      .artist img {
        display: block;
        width: 100%;
        height: 80%;
      }
      .artist h4 {
        text-align: center;
        color: white;
        margin-top: 10px;
        font-size: 15px;
      }
      #artists_container a{
          text-decoration:none;
      }
    </style>
  </head>
  <body >
    <div class="container">
      <h3 class="mt-2 ml-1 mb-3 text-primary">သီချင်းတောင်းကြမယ်
      <span style="color:black;font-size:16px">အစီအစဉ်မှ ကြိုဆိုပါတယ်</span></h3>
      <P style="color:black;font-size:15px; background-color:rgb(144,238,144);padding:5px;border-radius:5px;"> {{$lang}} ဘာသာစကားဖြင့်သီဆိုထားသော သီချင်းများကို သာ request လုပ်ပေးကြပါရန် မေတ္တောရပ်ခံအပ်ပါသည်။</P>

      <a href="{{route('getMostVotedSong',$lang)}}" style="text-decoration:none">
        <div class="artist text-black">
          <h4 style="color:black">တောင်းဆိုမှုအများဆုံးသောသီချင်းများ</h4>
        </div>
      </a>
      <div id="artists_container">
        @foreach ($artists as $artist)
          <a href="{{route('requestedSongList',$artist->id)}}" style="">
            <div class="artist text-black">
              <!--<img src="{{asset("public/assets/artists/$artist->name.png")}}" alt="" />-->
              <h4 style="color:black">{{$artist->name}}</h4>
            </div>
          </a>
        @endforeach
        
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
