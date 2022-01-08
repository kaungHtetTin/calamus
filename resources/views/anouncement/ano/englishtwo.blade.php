
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
        
        <div style="background-color:yellow; padding:1px;">
            <h6 class="m-1 mb-2" align="center">
                Announcement !
            </h6>
        </div>
      
      <p>
Calamus Education ရဲ့ Learning App တွေထဲက တစ်ခုဖြစ်တဲ့ Easy English App ကို စတင်အသုံးပြုနိုင်ပါပြီ။
</p>
<p>
Easy English App တွင် အင်္ဂလိပ်ဘာသာစကားကို Intermediate Level အထိသင်ကြားပေးသွားမှာဖြစ်ပြီး
App အသုံးပြုသူများအနေဖြင့် အခမဲ့ ဝင်ရောက်လေ့လာနိုင်မှာပဲဖြစ်ပါတယ်။
</p>
<p>
ယခုအခါတွင် Easy English ၏ Teacher များအနေဖြင့် Lesson များကို ပြင်ဆင်လျက်ရှိပြီး Easy English တွင် Basic course နှင့် အခြားသော
Additional Lesson မြောက်များစွာကိုလေ့လာနိုင်နေပြီဖြစ်ပါသည်။
</p>
<p>
Elementary Level, Pre Intermediate Level, Intermediate Level သင်ခန်းစာများကိုလည်း Easy English မှ အမြန်ဆုံးတင်ပေးသွားမည်ဖြစ်ပါသည်။
</p>
      
      
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

