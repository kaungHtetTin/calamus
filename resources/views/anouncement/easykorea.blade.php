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
         
            padding:10px;
            font-weight:bold;
            font-size:14px;
        }
        
        .appicon{
            width:40px;
            height:40px;
            margin-right:5px;
        }
        
        .playstore{
            font-weight:bold;
            text-align:right;
            color:rgb(25,25,112);
        }
        
    </style>
  </head>
  <body >
    <div style="padding:10px; background-color:rgb(245,245,245)">
        <img class="appicon" src="https://www.calamuseducation.com/appthumbs/kommmainicon.png">
        <span class="cate text-primary"> Easy Korean App </span>
        <div class="playstore">
            <br>
            Now Available On Playstore
            <span onclick="showAndroidToast('com.calamus.easykorean')" style="color:white; padding:8px ; border-radius:3px;" class="btn btn-primary" >
                    Install Now
            </span>
            
        </div>
        
         
               
        <script type="text/javascript">
                    function showAndroidToast(toast) {
                         
                         Android.goPlayStore(toast);

                    }
                </script>
    </div>

  </body>
</html>
