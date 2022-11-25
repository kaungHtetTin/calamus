<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      body {
        background-image: url("https://www.calamuseducation.com/uploads/inappads/easyenglishvipads1_bg.jpg");
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-attachment: fixed;
        background-position: center;
      }
      #koreanVip {
        width: 100%;
        margin-bottom: 0px;
        text-align: center;
      }
      #koreanVip img {
        width: 80%;
      }
      #benefitHeader {
        margin-top: 0px;
        display: flex;
        justify-content: center;
      }
      #benefitHeader p {
        background-color: black;
        color: white;
        text-align: center;
        padding: 10px;
        align-self: center;
        width: fit-content;
        border-radius: 5px;
      }
      #benefits {
        display: flex;
        justify-content: center;
        margin-bottom: 0px;
      }
      #benefits p {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 0px;
      }
      #discount {
        justify-content: center;
      }
      #discount p {
        color: red;
        font-weight: bold;
        text-align: center;
      }
      #btn {
        text-align: center;
        margin-top: 40px;
      }
      #btn button {
        border: 0px;
        background-color: red;
        color: white;
        padding: 10px 20px 10px 20px;
        border-radius: 10px;
        font-size: 17px;
      }
      #btn button:active {
        background-color: white;
        color: black;
        border: 0px;
      }
    </style>
  </head>
  <body>
    <div id="koreanVip"><img src="https://www.calamuseducation.com/uploads/inappads/easyenglishvipads1_text.png" alt="Korean VIP" /></div>
    <div id="benefitHeader"><p>VIP မှရရှိနိုင်သောအကျိုးကျေးဇူးများ</p></div>
    <div id="benefits">
      <p style="color:white">
        - ကြော်ငြာများကြည့်စရာမလိုတော့ခြင်း <br />
        - သင်ခန်းစာ VIDEO များကိုဒေါင်းလုပ်ဆွဲထား၍ OFFLINE လေ့လာနိုင်ခြင်း
        <br />
        - သင်ကြားနေသော COURSE အားလုံးကိုလေ့လာနိုင်ခြင်း (Intermediate ထိ Course
        များဖွင့်လှစ်သွားမည်)
      </p>
    </div>
    
    <div id="btn"><button onclick="showAndroidToast('Hello Android!')" class="bt-buy-now">Buy Now</button></div>

        
        <script type="text/javascript">
          function showAndroidToast(toast) {
            Android.showInAppAd(toast);

          }
        </script>

  </body>
</html>
