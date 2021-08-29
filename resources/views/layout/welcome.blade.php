<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Calamus Education</title>
    
  <link href="{{ asset ('public/css/mystyle.css')}}" rel="stylesheet">
  <link href="{{ asset ('public/css/bootstrap.min.css')}}" rel="stylesheet">
  
 
</head>

<body>
    
    <div class="container-fluid" id="mainDiv">
        
        <br><br>
        <div class="row">
            
            <div class="col-md-4 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
                
                @yield('welcome')
            
            </div>
            
            <div class="col-md-6  hidden-sm hidden-xs col-md-offset-0" style="text-align:center; height:100%"> <br><br>
                <img src="{{ asset ('public/assets/svg/feather.svg')}}" width="200px" >
                <h3>Calamus Education</h3>
            </div>
          
        </div>
        
        <br><br><br><br><br><br><br><br>
       
        <div class="row" style="background-color:#FFFDDF" >
            
                        
            <div class="col-md-3 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0" style="padding:10px; text-align:center">
                
                <b>Our Products</b>

            </div>
            
            <div class="col-md-3 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0" style="padding:10px; text-align:center">
                
                <b>Contact Us</b>

            </div>
            
            <div class="col-md-3 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0"  style="padding:10px ; text-align:center">
              <b>About Us</b>
            </div>
   
        
        </div>
    </div>

 
  <!-- Footer -->
  <footer style="background-color:#0A2B45">
    <div class="container" style="color:white">
        <br>
        <p class="m-0 text-center text-white">Copyright &copy; calamuseducation.com 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
</body>

</html>
 
 