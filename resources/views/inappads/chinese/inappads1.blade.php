<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background-image: url('https://www.calamuseducation.com/uploads/inappads/easykoreanvipads1.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            align-content: center;
            display: flex;
            justify-content: center;
             
        }

        .bt-buy-now{
        
            width: 150px;
            height: 50px;
            font-size: 20px;
            color: white;
            background: #FC2121;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.25);
            border-radius: 20px;
            position: absolute;
            margin: 0;
            top: 85%;
            
        }
    </style>


    
</head>
<body>

    <button onclick="showAndroidToast('Hello Android!')" class="bt-buy-now">Buy Now</button>
    
    
     <script type="text/javascript">
            function showAndroidToast(toast) {
            Android.showInAppAd(toast);

        }
    </script>
    

</body>
</html>
