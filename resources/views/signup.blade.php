@extends('layout.welcome')
 
@section('welcome')
 <div style="background-color:white; padding: 10px; margin:15px; border-radius:7px; text-align:center">
    <h4><b>Registration</b></h4>
    <br><br><br>
    <form method="post" action="">
        <div class="form-group">
            <input name="name" type="text" id="text" placeholder="Enter Your Name"><br><br>
            <input name="email" type="text" id="text" placeholder="Enter Your Email"><br><br>
            <input name="password" type="password" id="text" placeholder="Enter Your Password"><br><br>
            <input type="submit" id="button" value="   Sign Up   " width="50%">
        </div> 
    
    </form>
    <br>
    <a  href="{{route('login')}}"> Already Register? Login </a><b></b>
    <br><br>  
                    
</div>
    
@endsection