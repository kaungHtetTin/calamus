
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Hello, world!</title>
    <style>
      .selectedSong {
        background-color: #ff9f68;
        background-size: 80% 80%;
      }
      .songButton {
        display: flex;
        border: 0;
        margin-bottom: 10px;
        width: 100%;
        padding: 7px;
        border-radius: 2px;
        transition: ease 0.5s;
      }
      .vote {
        flex: 1;
        text-align: end;
        margin-right: 10;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h6 class="m-1 mb-2">
          Easy Korean app လေးမှာ ဘယ်အပိုင်းတွေကို အဓိကထားလေ့လာဖြစ်ကြလဲ &#129488;
      </h6>
      
      
        @foreach($weekSongs as $weekSong)

        <button class="songButton">
        <span>{{$weekSong->song_name}}</span>
        <span class="songNameList" style="display:none">{{$weekSong->id}}</span>
        <span class="vote"
          ><span class="voteCount">{{$weekSong->votes}} </span><i class="fa fa-thumbs-o-up"></i>
        </span>
        </button>
            
        @endforeach
      
      
      <form action="{{route('songRequest',$userid)}}" method="post">
        @csrf
        <div class="d-flex justify-content-end">
          <button
            type="submit"
            class="sendButton btn btn-primary w-100 m-1 disabled"
          >
            Send
          </button>
          <input type="text" name="songName" id="songName" value=""hidden />
        </div>
      </form>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
      crossorigin="anonymous"
    ></script>
    <script>
      $(document).ready(function () {
        $(".songButton").click(function () {
          $(".songButton").removeClass("selectedSong");
          var currentButton = $(this);
          currentButton.toggleClass("selectedSong");
          $(".sendButton").removeClass("disabled");
          document.getElementById("songName").value =$(".songNameList",currentButton).html();
        });
      });

    </script>
  </body>
</html>

