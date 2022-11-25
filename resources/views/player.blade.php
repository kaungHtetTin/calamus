<html>
    <head>
        <title>Calamus Education</title>
    </head>
    <body style="">
     <!--#00ADEF-->
        <div style="padding:53.13% 0 0 0;position:relative;background-color:black"><iframe src="{{$post->vimeo}}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" 
                  title=""></iframe>
        </div>
        
        <script src="https://player.vimeo.com/api/player.js"></script>
        <script>
            var iframe = document.querySelector('iframe');
            var player = new Vimeo.Player(iframe);
    
        
    
            player.on('play', function() {
              console.log('Played the video');
            });
    
            player.getVideoTitle().then(function(title) {
              console.log('title:', title);
            });
    
            player.getDuration().then(function(duration) {
                console.log('duration: ',duration)
                updateVideoDuration(duration);
            });
    
            function updateVideoDuration(duration){
              var ajax=new XMLHttpRequest();
              ajax.onload =function(){
                if(ajax.status==200 || ajax.readyState==4){
                  console.log(ajax.responseText);
                  console.log('<?php echo $post->post_id?>');
                }
              }
              ajax.open("POST","https://www.calamuseducation.com/calamin/api/lessons/updatevideoduration",true);
              ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              ajax.send("user_id=10000&date=<?php echo $post->post_id?>&duration="+duration);
            }
        </script>
    </body>
</html>