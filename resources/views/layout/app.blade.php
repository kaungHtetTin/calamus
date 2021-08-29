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
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#DFF4FF;width: 100%;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="#" Style="color:black; font-weight:bold ">Calamus</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="{{route('home')}}" Style="color:black">Home</a></li>
            <li><a href="#" Style="color:black">Video</a></li>
          </ul>
          
        </div>
      </div>
    </nav>

    
    <div class="container-fluid">
        <br><br><br>
           @yield('content')
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
 
 