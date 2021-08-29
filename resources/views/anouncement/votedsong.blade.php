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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
    />
    <title>detail</title>
    <script>
        function validateForm() {
            var x = document.forms["myForm"]["requestedSongName"].value;
            if (x == "" || x == null) {
                alert("Must be filled with something");
            return false;
             }
        }
</script>
    <style>
      .song {
        border: 1px solid rgb(23, 23, 23);
        margin-bottom: 7px;
        border-radius: 5px;
        display: flex;
        text-align: left;
        position: relative;
      }
      .songName {
        flex: 1;
        padding: 10px;
      }
      .voteIcon {
        background-color: white;
        display: flex;
        align-items: center;
        padding: 10px;
        transition: ease 0.2s;
        margin:3px;
      }
      .voteIcon:active {
        background-color: rgb(175, 216, 252);
      }
      #addSongButton {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        font-weight: bold;
        border: 0px;
        border-radius: 5px;
        margin-top: 20px;
        transition: ease 0.2s;
        padding: 10px 0px;
      }
      #addSongButton:active {
        background-color: rgb(226, 226, 226);
        color: rgb(8, 156, 8);
      }
      #note {
        font-size: 13px;
        border: 1px solid gray;
        padding: 10px;
      }
      h3 {
      }
    </style>
  </head>
  <body>
      @csrf
    <div class="container pt-4">
      <h5 id="note">
        မိမိကြိုက်နှစ်သက်သောသီချင်းသည် တောင်းဆိုထားသော စာရင်းပါဝင်ပါက မိမိတောင်းဆိုလိုသော သီချင်းကို နှိပ်ပြီး vote ပေးရမည်ဖြစ်ပါသည်။ <br><br>
        Vote အများဆုံးသီချင်းကိုရွေးချယ်ပြီးတင်ပေးမှာမို့ vote လေးတွေပြန့်မသွားရလေအောင် ရှိပြီးသားသီချင်းလေးတွေဆို အသစ်မထည့်ပဲ vote နှိပ်ပေးပါနော်
      </h5>
    
      <h3 class="mb-3 text-primary"><span id="groupName">တောင်းဆိုမှုအများဆုံးသောသီချင်းများ</h3>
      @foreach ($songs as $song)
        <form action="{{route('voteASong',$userid)}}" method="post">
          @csrf
            <input type="text" name="songid" value={{$song->id}} hidden />
            <button
            type="submit"
            class="song btn btn-white w-100">
              <div class="songName">{{$song->name}}</div>
              <div class="songName" style="font-size:12px">{{$song->artist}}</div>
              <div class="voteIcon">{{$song->vote}} 
                @if ($song->voted==1)
                <i class="fa fa-thumbs-up" style="font-size:18px;color:rgb(98, 109, 255); margin-left:5px"></i>  
                @else
                <i class="fa fa-thumbs-up" style="font-size:18px;color:#bbb; margin-left:5px"></i>
                @endif
              
              </div>
          
          </button>
        
        </form>
      @endforeach

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
