<!DOCTYPE HTML>
<html>
<head>
    @include('layouts.include.all-header-asset')
    @yield('header-script')   
</head> 
<body class="cbp-spmenu-push">
<div class="main-content">
@include('layouts.include.navbar')
  <!--left-fixed -navigation-->
    
  <!-- header-starts -->
@include('layouts.include.header')
  <!-- //header-ends -->
  <!-- main content start-->
@yield('content')
<!--footer-->
@include('layouts.include.footer')
<!--//footer-->
</div>
        
  <!-- new added graphs chart js-->
    
@include('layouts.include.all-footer-asset')
@yield('footer-script')    
</body>
</html>