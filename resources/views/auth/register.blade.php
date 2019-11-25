<!DOCTYPE HTML>
<html>
<head>
<title>Admin Panel | SignUp </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="{{ asset('back/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="{{ asset('back/css/style.css') }}" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="{{ asset('back/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- //font-awesome icons CSS -->

 <!-- side nav css file -->
 <link href='{{ asset('back/css/SidebarNav.min.css') }}' media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="{{ asset('back/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('back/js/modernizr.custom.js') }}"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 

<!-- Metis Menu -->
<script src="{{ asset('back/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('back/js/custom.js') }}"></script>
<link href="{{ asset('back/css/custom.css') }}" rel="stylesheet">
<!--//Metis Menu -->

</head> 
<body>
    <div class="main-content">
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page signup-page">
                <h2 class="title1">SignUp Here</h2>
                <div class="sign-up-row widget-shadow">
                    <h5>Personal Information :</h5>
                <form action="{{ route('register') }}" method="post">
                  @csrf
                    <div class="sign-u">
                        <input type="text" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                        <input type="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"> </div>
                    </div>
                    <h6>Login Information :</h6>
                    <div class="sign-u">
                        <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                        <input type="password" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password" required autocomplete="new-password">
                        </div>
                        <div class="clearfix"> </div>
                    <div class="sub_home">
                        <input type="submit" value="Submit">
                        <div class="clearfix"> </div>
                    </div>
                    <div class="registration">
                        Already Registered.
                        <a class="" href="{{ route('login') }}">
                            Login
                        </a>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--footer-->
        <div class="footer">
           <p>&copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
        </div>
        <!--//footer-->
    </div>
    
    <!--scrolling js-->
    <script src="{{ asset('back/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('back/js/scripts.js') }}"></script>
    <!--//scrolling js-->
    
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('back/js/bootstrap.js') }}"> </script>
    
</body>
</html>